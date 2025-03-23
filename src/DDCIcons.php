<?php
declare(strict_types = 1);

namespace Simbiat;

/**
 * Class to provide path to icons for Matomo Device Detector
 */
class DDCIcons
{
    /**
     * Base for path to return without trailing slash
     * @var string
     */
    public static string $basePath = '/assets/images/devicedetector';
    
    /**
     * Priority of extensions that can be used when searching for a file
     * @var array|string[]
     */
    public static array $extensionPriority = [
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
    public static array $namesToReplace = [
        'OS/2' => 'OS2',
        'GNU/Linux' => 'GNULinux',
        'MTK / Nucleus' => 'MTK  Nucleus',
        'Perl REST::Client' => 'Perl RESTClient',
        'HTTP:Tiny' => 'HTTP Tiny',
        'AUX' => 'ＡＵＸ',
    ];
    
    /**
     * List of paths to use relative to script file and without trailing slash
     * @var array|string[]
     */
    public static array $paths = [
        'iconsRoot' => '/icons',
        'bot' => '/bot',
        'botCategory' => '/bot/category',
        'clientRoot' => '/client',
        'clientType' => '/client/type',
        'browser' => '/client/browser',
        'browserFamily' => '/client/browser/family',
        'browserEngine' => '/client/browser/engine',
        'os' => '/client/os',
        'osFamily' => '/client/os/family',
        'brand' => '/device/brand',
        'deviceType' => '/device/type',
    ];
    
    /**
     * Icon to use in case no icon is found relative to $basePath
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
        return self::$basePath.(self::getIcon($bot, self::$paths['bot']) ?? self::getIcon($category ?? '', self::$paths['botCategory']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a bot category
     * @param string $category Bot category name
     *
     * @return string
     */
    public static function getBotCategory(string $category): string
    {
        return self::$basePath.(self::getIcon($category, self::$paths['botCategory']) ?? self::$fallback);
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
        return self::$basePath.(self::getIcon($browser, self::$paths['browser']) ?? self::getIcon($family ?? '', self::$paths['browserFamily']) ?? self::getIcon($engine ?? '', self::$paths['browserEngine']) ?? self::getIcon('browser', self::$paths['clientType']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a browser family
     * @param string $family Name of the browser family
     *
     * @return string
     */
    public static function getBrowserFamily(string $family): string
    {
        return self::$basePath.(self::getIcon($family, self::$paths['browserFamily']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a browser engine
     * @param string $engine Name of the browser engine
     *
     * @return string
     */
    public static function getBrowserEngine(string $engine): string
    {
        return self::$basePath.(self::getIcon($engine, self::$paths['browserEngine']) ?? self::$fallback);
    }
    
    /**
     * Get icon for an OS
     * @param string      $OS     Name of the browser
     * @param string|null $family Optional OS family to get icon if OS icon is not found
     *
     * @return string
     */
    public static function getOS(string $OS, ?string $family = null): string
    {
        return self::$basePath.(self::getIcon($OS, self::$paths['os']) ?? self::getIcon($family ?? '', self::$paths['osFamily']) ?? self::getIcon('os', self::$paths['clientType']) ?? self::$fallback);
    }
    
    /**
     * Get icon for an OS family
     * @param string $family Name of the OS family
     *
     * @return string
     */
    public static function getOSFamily(string $family): string
    {
        return self::$basePath.(self::getIcon($family, self::$paths['osFamily']) ?? self::$fallback);
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
        return self::$basePath.(self::getIcon($client, self::$paths['clientRoot'].'/'.$type) ?? self::getIcon($type, self::$paths['clientType']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a client type
     * @param string $type Client type name
     *
     * @return string
     */
    public static function getClientType(string $type): string
    {
        return self::$basePath.(self::getIcon($type, self::$paths['clientType']) ?? self::$fallback);
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
        return self::$basePath.(self::getIcon($type, self::$paths['brand']) ?? self::getIcon($type ?? '', self::$paths['deviceType']) ?? self::$fallback);
    }
    
    /**
     * Get icon for a device type
     * @param string $type Name of the device type
     *
     * @return string
     */
    public static function getDeviceType(string $type): string
    {
        return self::$basePath.(self::getIcon($type, self::$paths['deviceType']) ?? self::$fallback);
    }
    
    /**
     * Get path to the icon
     * @param string $name Name of the file to check for
     * @param string $path Path to look in
     *
     * @return string|null
     */
    private static function getIcon(string $name, string $path): ?string
    {
        #Replace certain names
        $name = str_replace(array_keys(self::$namesToReplace), array_values(self::$namesToReplace), $name);
        foreach (self::$extensionPriority as $extension) {
            if (file_exists(__DIR__.self::$paths['iconsRoot'].$path.'/'.$name.'.'.$extension)) {
                return $path.'/'.$name.'.'.$extension;
            }
        }
        return null;
    }
}