<?php
/**
 * Loading helper used for WordPress < 6.6
 * 
 * @deprecated
 * @noinspection PhpDeprecationInspection
 * @noinspection PhpUnusedParameterInspection
 * @noinspection DuplicatedCode
 * @noinspection PhpUnused
 */
class Loco_hooks_LegacyLoadHelper extends Loco_hooks_Hookable {
    
    /**
     * theme/plugin text domain loading context in progress
     * @var string[] [ $subdir, $domain, $locale ]
     */
    private $context;

    /**
     * Protects against recursive calls to load_textdomain()
     * @var bool[]
     */    
    private $lock = [];

    /**
     * Custom/safe directory path with trailing slash
     * @var string
     */
    private $base;

    /**
     * Locations that can be mapped to equivalent paths under custom directory
     * @var array[]
     */
    private $map = [];

    /**
     * Deferred JSON files under our custom directory, indexed by script handle
     * @var string[]
     */
    private $json = [];

    /**
     * Registry of text domains we've seen, whether loaded or not. This will catch early JIT problem.
     */
    private $seen = [];
    

    /**
     * {@inheritDoc}
     */
    public function __construct(){
        parent::__construct();
        $this->base = trailingslashit( loco_constant('LOCO_LANG_DIR') );
        // add system locations which have direct equivalent custom/safe locations under LOCO_LANG_DIR
        // not adding theme paths because as long as load_theme_textdomain is used they will be mapped by context.
        $this->add('', loco_constant('WP_LANG_DIR') )
             ->add('plugins/', loco_constant('WP_PLUGIN_DIR') )
             ->add('plugins/', loco_constant('WPMU_PLUGIN_DIR') )
        ;
        // Text domains loaded prematurely won't be customizable, unless explicitly loaded later.
        // Use the loco_unload_early_textdomain filter to force unloading. Not doing so may fire loco_unseen_textdomain later.
        global $l10n;
        if( $l10n && is_array($l10n) ){
            foreach( $l10n as $domain => $value ){
                if( apply_filters('loco_unload_early_textdomain',false,$domain,$value) ){
                    unload_textdomain($domain);
                    unset($GLOBALS['l10n_unloaded'][$domain]);
                    do_action('loco_unloaded_textdomain',$domain);
                }
            }
        }
    }


    /**
     * Add a mappable location
     * @param string $subdir
     * @param string $path
     * @return self
     */
    private function add( $subdir, $path ){
        if( $path ){
            $path = trailingslashit($path);
            $this->map[] = [ $subdir, $path, strlen($path) ];
        }
        return $this;
    }


    /**
     * Map a file directly from a standard system location to LOCO_LANG_DIR.
     * - this does not check if file exists, only what the path should be.
     * - this does not handle filename differences (so won't work with themes)
     * @param string $path e.g. {WP_CONTENT_DIR}/languages/plugins/foo or {WP_PLUGIN_DIR}/foo/anything/foo
     * @return string e.g. {WP_CONTENT_DIR}/languages/loco/plugins/foo
     */
    private function resolve( $path ){
        foreach( $this->map as $data ){
            list($subdir,$prefix,$len) = $data;
            if( substr($path,0,$len) === $prefix ){
                if( '' === $subdir ){
                    return $this->base.substr($path,$len);
                }
                return $this->base.$subdir.basename($path);
            }
        }
        return '';
    }


    /**
     * `theme_locale` filter callback.
     * Signals the beginning of a "load_theme_textdomain" process
     * @param string $locale
     * @param string $domain
     * @return string
     */
    public function filter_theme_locale( $locale, $domain = '' ){
        $this->context = [ 'themes/', $domain, $locale ];
        unset( $this->lock[$domain] );
        return $locale;
    }


    /**
     * `plugin_locale` filter callback.
     * Signals the beginning of a "load_plugin_textdomain" process
     * @param string $locale
     * @param string $domain
     * @return string
     */
    public function filter_plugin_locale( $locale, $domain = '' ){
        $this->context = [ 'plugins/', $domain, $locale ];
        unset( $this->lock[$domain] );
        return $locale;
    }


    /**
     * `unload_textdomain` action callback.
     * Lets us release the lock, so that the custom file may be loaded again (hopefully for another locale)
     * @param string $domain
     * @return void
     */
    public function on_unload_textdomain( $domain ){
        unset( $this->lock[$domain] );
    }


    /**
     * `load_textdomain` action callback.
     * Lets us load our custom translations before WordPress loads what it had already decided to load.
     * We're deliberately not stopping WordPress loading $mopath, if it exists it will be merged on top of our custom strings.
     * @param string $domain
     * @param string $mopath
     * @return void
     */
    public function on_load_textdomain( $domain, $mopath ){
        $key = '';
        $this->seen[$domain] = true;
        // domains may be split into multiple files
        $name = pathinfo( $mopath, PATHINFO_FILENAME );
        if( $lpos = strrpos( $name, '-') ){
            $slug = substr( $name, 0, $lpos );
            if( $slug !== $domain ){
                $key = $slug;
            }
        }
        // avoid recursion when we've already handled this domain/slug
        if( isset($this->lock[$domain][$key]) ){
            return;
        }
        // if context is set, then a theme or plugin initialized the loading process properly
        if( is_array($this->context) ){
            list( $subdir, $_domain, $locale ) = $this->context;
            $this->context = null;
            if( $_domain !== $domain ){
                return;
            }
            $mopath = $this->base.$subdir.$domain.'-'.$locale.'.mo';
        }
        // else load_textdomain must have been called directly, including to load core domain
        else {
            $mopath = $this->resolve($mopath);
            if( '' === $mopath ){
                return;
            }
        }
        // Load our custom translations avoiding recursion back into this hook
        $this->lock[$domain][$key] = true;
        load_textdomain( $domain, $mopath );
    }



    /**
     * `lang_dir_for_domain` filter callback, requires WP>=6.6
     */
    public function filter_lang_dir_for_domain( $path, $domain, $locale ){
        // Empty path likely means JIT invocation with no system file installed.
        // This fix allows our custom files to be picked up, but not author provided files.
        if( ! $path ){
            foreach( ['plugins','themes'] as $type ){
                $dir = LOCO_LANG_DIR.'/'.$type.'/';
                if( is_dir($dir) ){
                    $base = $dir.$domain.'-'.$locale;
                    if( file_exists($base.'.mo') || file_exists($base.'.l10n.php') ){
                        return $dir;
                    }
                }
            }
        }
        return $path;
    }


    /**
     * Alert to the early JIT loading issue for any text domain queried before we've seen it be loaded. 
     */
    private function handle_unseen_textdomain( $domain ){
        if( ! array_key_exists($domain,$this->seen) ){
            $this->seen[$domain] = true;
            do_action('loco_unseen_textdomain',$domain);
        }
    }


    /**
     * `gettext` filter callback. Enabled only in Debug mode.
     */
    public function debug_gettext( $translation = '', $text = '', $domain = '' ){
        $this->handle_unseen_textdomain($domain?:'default');
        return $translation;
    }


    /**
     * `ngettext` filter callback. Enabled only in Debug mode.
     */
    public function debug_ngettext( $translation = '', $single = '', $plural = '', $number = 0, $domain = '' ){
        $this->handle_unseen_textdomain($domain?:'default');
        return $translation;
    }


    /**
     * `gettext_with_context` filter callback. Enabled only in Debug mode.
     */
    public function debug_gettext_with_context( $translation = '', $text = '', $context = '', $domain = '' ){
        $this->handle_unseen_textdomain($domain?:'default');
        return $translation;
    }


    /**
     * `ngettext_with_context` filter callback. Enabled only in Debug mode.
     */
    public function debug_ngettext_with_context( $translation = '', $single = '', $plural = '', $number = 0, $context = '', $domain = '' ){
        $this->handle_unseen_textdomain($domain?:'default');
        return $translation;
    }


    public function filter_load_script_translation_file( $path = '', $handle = '' ){
        // currently handle-based JSONs for author-provided translations will never map.
        if( is_string($path) && preg_match('/^-[a-f0-9]{32}\\.json$/',substr($path,-38) ) ){
            $custom = $this->resolve($path);
            if( $custom && is_readable($custom) ){
                // Defer until either JSON is resolved or final attempt passes an empty path.
                $this->json[$handle] = $custom;
            }
        }
        // If we return an unreadable file, load_script_translations will not fire.
        // However, we need to allow WordPress to try all files. Last attempt will have empty path
        else if( false === $path && array_key_exists($handle,$this->json) ){
            $path = $this->json[$handle];
            unset( $this->json[$handle] );
        }
        return $path;
    }


    public function filter_load_script_translations( $json = '', $path = '', $handle = '' ){
        if( array_key_exists($handle,$this->json) ){
            $path = $this->json[$handle];
            unset( $this->json[$handle] );
            $json = self::mergeJson( $json, file_get_contents($path) );
        }
        return $json;
    }


    private static function mergeJson( $json, $custom ){
        $fallbackJed = json_decode($json,true);
        $overrideJed = json_decode($custom,true);
        if( self::jedValid($fallbackJed) && self::jedValid($overrideJed) ){
            // Original key is probably "messages" instead of domain, but this could change at any time.
            // Although custom file should have domain key, there's no guarantee JSON wasn't overwritten or key changed.
            $overrideMessages = current($overrideJed['locale_data']);
            $fallbackMessages = current($fallbackJed['locale_data']);
            // We could merge headers, but custom file should be correct
            // $overrideMessages[''] += $fallbackMessages[''];
            // Continuing to use "messages" here as per WordPress. Good backward compatibility is likely.
            // Note that our custom JED is sparse (exported with empty keys absent). This is essential for + operator.
            $overrideJed['locale_data'] =  [
                'messages' => $overrideMessages + $fallbackMessages,
            ];
            // Note that envelope will be the custom one. No functional difference but demonstrates that merge worked.
            $overrideJed['merged'] = true;
            $json = json_encode($overrideJed);
        }
        // Handle situations where one or neither JSON strings are valid
        else if( self::jedValid($overrideJed) ){
            $json = $custom;
        }
        else if( ! self::jedValid($fallbackJed) ){
            $json = '';
        }
        return $json;
    }


    private static function jedValid( $jed ){
        return is_array($jed) &&  array_key_exists('locale_data',$jed) && is_array($jed['locale_data']) && $jed['locale_data'];
    }

    
}
