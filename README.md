# laravel_telegram_helper
کلاس کمکی ربات تلگرام و ارسال پیام به یک ربات تلگرام

بعد از اینکه فایل رو به پروژه خودتون اضافه کرد کد خط پایین رو به فایل ENV پروژه اتون اضافه کنید.

BOT_TOKEN='########'

توکن ربات خودتون رور اضافه کنید

حالا کافیه تو هرجایی از پروژه اتون یک شی از اون کلاس بسازید

$telegram = NEW TelegramApi();

برای دسترسی به متد های مختلف کلاس کافیه که اون متد رو صدا بزنید
برای مثال برای ارسال پیام به یک چت خاص از متد زیر استفاده کنید

$telegram->send();

این متد ازتون 2 تا پارامتر میخواد
پارامتر اول  آیدی کاربری که میخواین بهش پیام بدید
یعنی باید کاربر ربات رو استارت کرده باشه
پارامتر دوم متن پیام شما 
اونوقت میبینید که چقدر ساده پیام شما برای کاربر ارسال میشه.

دیگر متد های قابل دسترس

$telegram->get();
دریافت اطلاعات ربات شما که براتون بر میگردونه

$telegram->sendPhoto();

ارسال یک عکس برای کاربر که میتونه url یا آیدی اون عکس تو تلگرام باشه

$telegram->forwardMessage();
فوروراد کردن یک پیام برای کاربر

$telegram->sendLocation();
ارسال لوکیشن برای کاربر 



به زودی متد های بیشتری اضافه میشه
