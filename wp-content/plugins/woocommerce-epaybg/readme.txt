=== WooCommerce ePay.bg ===
Contributors: dimitrov.adrian
Donate link: https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=U3Q8DXVKKU5BL&lc=BG&item_name=WooCommerce%20ePay%2ebg&item_number=wpwcepaybg&currency_code=EUR&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted
Tags: WooCommerce, Payment, Gateway, epay.bg
Requires at least: 3.8
Tested up to: 4.9
Stable tag: 1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html


== Description ==

ePay.bg gateway for WooCommerce. More info at <a href="https://www.epay.bg/">epay.bg</a>.
Supports all ePay.bg payment methods: ePay.bg login account, BORICA and EasyPay payments.


== Screenshots ==

1. Widget settings screen
2. How it looks

== Frequently Asked Questions ==

= Кои са поддържаните валути =
Разширението работи директно с програмния интерфейс на ePay.bg което означава, че поддържаните валути се определят от тях.
Въпреки, че според документацията би следвало да може да се оперира и в USD и EUR към момента се поддържа само BGN, като това бе и отговор на запитване до поддръжката на ePay.bg
Това не означава, че плащания могат да се извършват само с български карти. При плащане с чужда карта превалутирането се извършва от банката издател на картата.

= Мога ли да събирам регулярни плащания с това разширение? =

Не

= Secret Key - откъде? =

Ключът се взема от административния панел за търговци. Необходимо е да се включите в системата на ePay.bg като търговец.

За да се включите в системата като търговец е необходимо да се регистрирате на сайта на ePay.bg като юридическо лице: https://www.epay.bg/reg/

= ePay.bg плащанията през акаунт минават, но през БОРИКА - НЕ =

Ако срещнете подобен проблем, трябва да се уверите, че сте активирали 3D Secure виртуален ПОС терминал.
Повече в [следната тема от форума](https://wordpress.org/support/topic/%D0%9F%D0%BB%D0%B0%D1%8E%D0%B0%D0%BD%D0%B5-%D1%81-%D0%BA%D0%B0%D1%80%D1%82%D0%B0-%D0%B1%D0%B5%D0%B7-%D0%B0%D0%BA%D0%B0%D1%83%D0%BD%D1%82-%D0%B2-epay)
И на страницата на [ePay.bg](https://www.epay.bg/v3main/front?p=on_line_store)

= Плащанията минават, но няма никаква обратна връзка. =

Причините за този проблем може да са най-различни.
Възможно е някое друго разширение или някоя тема да променят информацията в заявките което може да доведе до подобен проблем.
Изключете всички разширение и превключете на някоя стандартна тема за да проверите дали проблема се възпроизвежда.

Друго подобно явление може да се случи и при използването на mod_secure модула за apache

[Разгледайте също и темата](https://wordpress.org/support/topic/update-stock-quantity)


== Installation ==

1. Visit 'Plugins > Add New'
2. Search for 'WooCommerce ePay.bg Gateway'
3. Activate WooCommerce ePay.bg Gateway


== Changelog ==

= 1.4 =
* Fixed supported currencies
* Fixed order updates
* Fixed empty checksum check
* Typos and strings updates

= 1.3 =
* Added option to disable IPN check

= 1.2 =
* Fixed initial enabled setting value (https://wordpress.org/support/topic/easypay-is-always-visible-at-checkout)
* Fixed required minimum version to WC2.2

= 1.1 =
* Fixed wrong IPN notify url
* Added Bulgarian language

= 1.0 =
* First public release
