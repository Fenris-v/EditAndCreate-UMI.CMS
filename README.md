# Простой скрирт для редактирования и создания страниц в UMI.CMS
___
1.  Закинуть файлы в корень, либо на свое усмотрение.  
2.  Добавить разрешение на выполнение данных скриптов в `.htaccess`. Например, дописать в конец файла:  
```
<FilesMatch "^apiPageEditProp\.php$">
  Allow from all
  php_flag engine on
</FilesMatch>

<FilesMatch "^apiCreatePage\.php$">
  Allow from all
  php_flag engine on
</FilesMatch>
```
Запустить соответствующий скрипт, например:
```
https://domain.ru/apiCreatePage.php
```