<?php
declare(strict_types = 1);

namespace Simbiat;

/**
 * Class to provide a path to icons for Matomo Device Detector
 */
class DDCIcons
{
    /**
     * Base for the path to return without trailing slash
     * @var string
     */
    public static string $base_path = '/assets/images/devicedetector';
    
    /**
     * Priority of extensions that can be used when searching for a file
     * @var array|string[]
     */
    public static array $extension_priority = [
        0 => 'svg',
        1 => 'avif',
        2 => 'webp',
        3 => 'png',
        4 => 'jpg',
        5 => 'jpeg',
        6 => 'jxl',
        7 => 'heic',
        8 => 'gif',
    ];
    
    /**
     * List of names to be replaced due to file systems' limitations
     * @var array|string[]
     */
    public static array $names_to_replace = [
        'OS/2' => 'OS2',
        'GNU/Linux' => 'GNULinux',
        'MTK / Nucleus' => 'MTK  Nucleus',
        'Perl REST::Client' => 'Perl RESTClient',
        'HTTP:Tiny' => 'HTTP Tiny',
        'AUX' => 'ＡＵＸ',
    ];
    
    /**
     * List of paths to use relative to the script file and without trailing slash
     * @var array|string[]
     */
    public static array $paths = [
        'icons_root' => '/icons',
        'bot' => '/bot',
        'bot_category' => '/bot/category',
        'client_root' => '/client',
        'client_type' => '/client/type',
        'browser' => '/client/browser',
        'browser_family' => '/client/browser/family',
        'browser_engine' => '/client/browser/engine',
        'os' => '/client/os',
        'os_family' => '/client/os/family',
        'brand' => '/device/brand',
        'device_type' => '/device/type',
    ];
    
    /**
     * Icon to use in case no icon is found relative to $base_path
     * @var string
     */
    public static string $fallback = '/Matomo.svg';
    
    /**
     * Get icon for a bot
     * @param string      $bot      Name of the bot
     * @param string|null $category Optional bot category to get icon if bot icon is not found
     *
     * @return string
     */
    public static function getBot(string $bot, ?string $category = null): string
    {
        return self::$base_path.(self::getIcon($bot, self::$paths['bot']) ?? self::getIcon($category ?? '', self::$paths['bot_category']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a bot category
     * @param string $category Bot category name
     *
     * @return string
     */
    public static function getBotCategory(string $category): string
    {
        return self::$base_path.(self::getIcon($category, self::$paths['bot_category']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a browser
     * @param string      $browser Name of the browser
     * @param string|null $family  Optional browser family to get icon if browser icon is not found
     * @param string|null $engine  Optional browser engine to get icon if browser family icon is not found
     *
     * @return string
     */
    public static function getBrowser(string $browser, ?string $family = null, ?string $engine = null): string
    {
        return self::$base_path.(self::getIcon($browser, self::$paths['browser']) ?? self::getIcon($family ?? '', self::$paths['browser_family']) ?? self::getIcon($engine ?? '', self::$paths['browser_engine']) ?? self::getIcon('browser', self::$paths['client_type']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a browser family
     * @param string $family Name of the browser family
     *
     * @return string
     */
    public static function getBrowserFamily(string $family): string
    {
        return self::$base_path.(self::getIcon($family, self::$paths['browser_family']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a browser engine
     * @param string $engine Name of the browser engine
     *
     * @return string
     */
    public static function getBrowserEngine(string $engine): string
    {
        return self::$base_path.(self::getIcon($engine, self::$paths['browser_engine']) ?? self::$fallback);
    }
    
    /**
     * Get icon for an OS
     * @param string      $os     Name of the browser
     * @param string|null $family Optional OS family to get icon if OS icon is not found
     *
     * @return string
     */
    public static function getOS(string $os, ?string $family = null): string
    {
        return self::$base_path.(self::getIcon($os, self::$paths['os']) ?? self::getIcon($family ?? '', self::$paths['os_family']) ?? self::getIcon('os', self::$paths['client_type']) ?? self::$fallback);
    }
    
    /**
     * Get icon for an OS family
     * @param string $family Name of the OS family
     *
     * @return string
     */
    public static function getOSFamily(string $family): string
    {
        return self::$base_path.(self::getIcon($family, self::$paths['os_family']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a client
     * @param string $client Name of the client
     * @param string $type   Optional client type to get icon if client icon is not found
     *
     * @return string
     */
    public static function getClient(string $client, string $type): string
    {
        return self::$base_path.(self::getIcon($client, self::$paths['client_root'].'/'.$type) ?? self::getIcon($type, self::$paths['client_type']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a client type
     * @param string $type Client type name
     *
     * @return string
     */
    public static function getClientType(string $type): string
    {
        return self::$base_path.(self::getIcon($type, self::$paths['client_type']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a brand
     * @param string      $brand Name of the brand
     * @param string|null $type  Optional device type to get icon if brand icon is not found
     *
     * @return string
     */
    public static function getBrand(string $brand, ?string $type = null): string
    {
        return self::$base_path.(self::getIcon($brand, self::$paths['brand']) ?? self::getIcon($type ?? '', self::$paths['device_type']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a device type
     * @param string $type Name of the device type
     *
     * @return string
     */
    public static function getDeviceType(string $type): string
    {
        return self::$base_path.(self::getIcon($type, self::$paths['device_type']) ?? self::$fallback);
    }
    
    /**
     * Get the path to the icon
     * @param string $name Name of the file to check for
     * @param string $path Path to look in
     *
     * @return string|null
     */
    private static function getIcon(string $name, string $path): ?string
    {
        #Replace certain names
        $name = str_replace(array_keys(self::$names_to_replace), self::$names_to_replace, $name);
        foreach (self::$extension_priority as $extension) {
            if (file_exists(__DIR__.self::$paths['icons_root'].$path.'/'.$name.'.'.$extension)) {
                return $path.'/'.$name.'.'.$extension;
            }
        }
        return null;
    }
}