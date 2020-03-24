<?php

    /**
     * ВАЖНО! Для выполнения скриптов, необходимо прописать разрешение в .htaccess
     */

    header("Content-type:text/html;charset=utf-8");
    include "standalone.php";

    /**
     * получение страницы и редактирование ее свойств
     */
    $hierarchy = umiHierarchy::getInstance();
    $elementPath = '/shop/bytovaya-tehnika/duhovye-shkafy/vstraivaemyj-elektricheskij-duhovoj-shkaf-hotpoint-ariston-fi7-861-sh-ic-ha/';

    // получаем id страницы по ее url'у
    $elementId = $hierarchy->getIdByPath($elementPath);

    if ($elementId === false) {
        echo 'Нет страницы с таким адресом';
    }

    // Получим экземпляр страницы через ее id
    $element = $hierarchy->getElement($elementId);

    // Проверим, что получен верный результат
    if ($element instanceof umiHierarchyElement) {
        // показать заголовок страницы
        echo "Page with title: \"", $element->getValue('h1'), "\"<br />\n";
        echo $element->getValue('photo'), "<br />\n";

        // изменение заголовка и названия страницы
        $element->setName("store of old goods");
        $element->setValue('h1', 'old goods store');
        $element->commit();

        // новый заголовок
        echo "теперь заголовок такой: \"", $element->getValue('h1'), "\"<br/>\n";
    } else {
        echo 'не удалось получить страницу';
    }