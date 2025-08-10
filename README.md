This is a collection of icons/logos for operating systems and various applications detected by [Matomo's Device Detector](https://github.com/matomo-org/device-detector) except AFNetworking apps (need specific names). Expected use case: an audit page showing data on past user logins or current sessions.  
While most icons are 100% "official" (at the time of addition), for some more obscure or old ones I can't guarantee that a proper icon is being used. In fact, for some of them the icon/logo of the respective owning company or avatar of original creator is used.  
For format consistency sake some icons may have been edited slightly:

- spacing added to make up perfect squares
- excessive spacing removed, but to still keep the square ratio
- all icons with dimensions over 1200x1200 pixels were resized to 1200x1200 (I doubt that anyone would need larger versions for potential use cases)
- side-text removed, unless necessary for differentiation of the icon from similar yet unrelated ones or essential to the logo
- solid background removed (for transparency), unless it is part of the brand, or it was otherwise deemed important to readability
- all icons were converted to lossless WebP format except for `device/type`, `client/type`, `bot/category`, which are in SVG (all taken from [svgrepo](https://www.svgrepo.com/)) to allow adjusting their colors through CSS to suit the website's style, if needed
- names of the files for `OS/2`, `GNU/Linux`, `MTK / Nucleus`, `Perl REST::Client`, `HTTP:Tiny`, `AUX` were changed to `OS2`, `GNULinux`, `MTK  Nucleus`, `Perl RESTClient`, `HTTP Tiny`, `ＡＵＸ` respectively due to special symbols

If desired, you can see all the icons from the collection on one page [here](https://www.simbiat.eu/simplepages/devicedetector/).

Collection also comes with a custom class `\Simbiat\DDCIcons` that can help get respective icon with support of variable images formats (with prioritization) and a fallback icon.  
Functions available:

- `getBot(string $bot, ?string $category = null)`
- `getBotCategory(string $category)`
- `getBrowser(string $browser, ?string $family = null, ?string $engine = null)`
- `getBrowserFamily(string $family)`
- `getBrowserEngine(string $engine)`
- `getOS(string $os, ?string $family = null)`
- `getOSFamily(string $family)`
- `getClient(string $client, string $type)`
- `getClientType(string $type)`
- `getBrand(string $brand, ?string $type = null)`
- `getDeviceType(string $type)`

Names of the functions should be self-explanatory, and all of them require at least the name of the respective entity. with `getClient` also requiring the type of the client. Some of the functions also support optional arguments that allow alternative fallback icons, if found.

Class has the following settings:

- `string $base_path` - base path to be attached to the returned value, which will complete the value to a usable URL for your website. Note that you _may_ need to use rewrite rules in the web server settings to actually make the files accessible, though.
- `array $extension_priority` - priority of the file formats. If a folder has multiple versions of an icon, the fist one existing will be used. The lower case is expected both in the array and in the actual files.
- `array $names_to_replace` - names that will need to be replaced due to file systems' limitation or for other reasons (if customized).
- `array $paths` - paths used by the class. Do not change, unless you know what you are doing.
- `string $fallback` - default fallback icon relative to `$base_path`. Same as with `$base_path` you may need to use rewrite rules in the web server settings to make it accessible for clients.

Note: while release versions are meant to match the current release of DeviceDetector (with added datestamps to identify local changes between them), they _may_ lag behind a little bit or not change, if new DeviceDetector release did not have new entities.