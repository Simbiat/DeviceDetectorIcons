This is a collection of icons/logos for operating systems and various applications detected by [Matomo's Device Detector](https://github.com/matomo-org/device-detector) except AFNetworking apps (need specific names). Expected use case: an audit page showing data on past user logins or current sessions.  
General logic of selecting an icon is like this:

1. Use the latest official one, if exists
2. Use the highest possible resolution, but no more than 1200x1200 pixels (unless SVG).
3. Regardless of resolution, the icon should be without obvious blur or artefacts, where possible. This includes blur, pixelation, deformities and the like caused by resizing of the image (original was 200x200px, and was resized to 1000x1000px).
4. If latest official one is of poor quality or of low resolution, but an older icon exists with better quality - prefer that one.
5. If it is unclear what is the latest official icon (for example 2 different icons are used by the brand in multiple places), the one that is used most often based on search results or the one that is more recognizable (often same thing) should be used.
6. Icon should have transparent background, unless it's part of a brand or the background is used in official application icon on application stores.
7. Icon should not have text on it, unless it's integrated into an image, brand does not have a logo that's not just text (stylized or not) or lack of text will result in no differentiation from other distinct icons.
8. If there is no official icon at all, unofficial one can be used, as long as it is distinct enough and follows other principles as well.
9. In case of open source project with no official and no unofficial icons, avatar of original creator can be used. In case there is none, or it's not distinct enough, icon for the main programming language can be used or just name of the project.
10. Regardless of the icon selected, it should be modified, if needed to have square ratio, but at the same as little whitespace around the actual elements of the icon as needed to maintain the square ratio.

The above rules should be followed for new contributions as well. If they cannot be followed, this should be justified in PR description.

For consistency’s sake all icons were converted to lossless WebP (and minimized with [TinyPNG](https://tinypng.com)) format except for `device/type`, `client/type`, `bot/category`, which are in SVG (all taken from [svgrepo](https://www.svgrepo.com/)) to allow adjusting their colors through CSS to suit the website's style, if needed. Format is not enforced for contributions, due to included PHP class, but use of WebP and TinyPNG is still recommended, when possible.

In addition, names of the files for `OS/2`, `GNU/Linux`, `MTK / Nucleus`, `Perl REST::Client`, `HTTP:Tiny`, `AUX`, `MariaDB/MySQL Knowledge Base` were changed to `OS2`, `GNULinux`, `MTK  Nucleus`, `Perl RESTClient`, `HTTP Tiny`, `ＡＵＸ`, `MariaDB MySQL Knowledge Base` respectively due to special symbols. If new contributions have special symbols as well, PHP class should be updated in same PR as well.

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