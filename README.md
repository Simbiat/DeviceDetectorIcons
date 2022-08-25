This is collection of icons/logos for operating systems and various applications detected by [Matomo's Device Detector](https://github.com/matomo-org/device-detector) except AFNetworking apps (need specific names). Expected use case: an audit page showing data on past user logins or current sessions.  
While most icons are 100% "official" (at the time of addition), for some more obscure or old ones I can't guarantee that a proper icon is being used. In fact, for some of them icon/logo of respective owning company or avatar of original creator is used.  
For format consistency's sake some icons may have been edited slightly:
- spacing added to make up perfect squares
- excessive spacing removed, but to still keep square ratio
- all icons with dimensions over 1200x1200 pixels were resized to 1200x1200 (I doubt that anyone would need larger versions for potential use cases)
- side-text removed, unless necessary for differentiation of the icon from similar yet unrelated ones or essential to the logo
- solid background removed (for transparency), unless it is part of the brand, or it otherwise deemed important to readability
- all icons were converted to lossless WebP format
- names of the files for `OS/2`, `GNU/Linux`, `MTK / Nucleus` and `Perl REST::Client` were changed to `OS2`, `GNULinux`, `MTK  Nucleus` and `Perl RESTClient` respectively due to special symbols

If desired, you can see all the icons from the collection on one page [here](https://www.simbiat.ru/staticpages/devicedetector/).

Example of convenient use in PHP:
```php
#Initialize device detector
$dd = (new \DeviceDetector\DeviceDetector($_SERVER['HTTP_USER_AGENT']));
$dd->parse();
#Get OS
$os = $dd->getOs();
#Get client
$client = $dd->getClient();
#Set OS and client icon if they exist
if (is_file('/img/devicedetector/os/'.$os['name'].'.webp')) {
    $os['icon'] = '/img/devicedetector/os/'.$os['name'].'.webp';
}
if (is_file('/img/devicedetector/'.$client['type'].'/'.$client['name'].'.webp')) {
    $client['icon'] = '/img/devicedetector/'.$client['type'].'/'.$client['name'].'.webp';
}
```
For a more elaborate use (audit page), check this [php](https://github.com/Simbiat/simbiat.ru/blob/master/lib/simbiat.ru/src/usercontrol/Pages/Sessions.php) (for backend) and [twig](https://github.com/Simbiat/simbiat.ru/blob/master/twig/usercontrol/sessions.twig) (for frontend) files.
