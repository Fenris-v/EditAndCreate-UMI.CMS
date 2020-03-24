<?php

    /**
     * ВАЖНО! Для выполнения скриптов, необходимо прописать разрешение в .htaccess
     */

    header("Content-type:text/html; charset=utf-8");
    include "standalone.php";

    /**
     * создание страницы и редактирование ее свойств
     */

    // определение свойств страницы, которую будем создавать
    $newElementName = 'Item';
    $newElementAltName = 'item_good';
    $newElementMetaDesc = <<<ANONS
Short description
ANONS;
    $newElementContent = <<<CONTENT
<p>Long description</p>
<p>Long description</p>
<p>Long description</p>
<p>Long description</p>
<p>Long description</p>
<p>Long description</p>
CONTENT;
    $newElementImg = './images/Bytovaya_tehnika/344399d7914cdfe38067dbb698ad9329d2c886af3d2ce30e825163c29f8b4f03.jpg';
    $newElementPrice = rand() + 1;

    // получаем иерархических тип страницы
    $hierarchyTypes = umiHierarchyTypesCollection::getInstance();

    /**
     * посмотреть список доступных типов
     * удалить для рабочей версии скрипта
     */
?>
<!--    <pre>-->
<!--    --><?//= print_r($hierarchyTypes->getTypesList()); ?>
<!--</pre>-->
<?php

    /**
     * продолжение работы с типом данных
     */
    // в данном варианте создается объект каталога
    $hierarchyType = $hierarchyTypes->getTypeByName('catalog', 'object');
    $hierarchyTypeId = $hierarchyType->getId();

    $hierarchy = umiHierarchy::getInstance();

    // получаем id родительской страницы
    $parentElementId = $hierarchy->getIdByPath('/shop/');

    // добавляем новый элемент
    $newElementId = $hierarchy->addElement($parentElementId, $hierarchyTypeId, $newElementName, $newElementAltName);
    if ($newElementId === false) {
        echo 'Не удалось создать новую страницу';
    }

    // установим права на страницу в дефолтное состояние
    $permission = permissionsCollection::getInstance();
    $permission->setDefaultPermissions($newElementId);

    // получим экземпляр страницы
    $newElement = $hierarchy->getElement($newElementId);

    if ($newElement instanceof umiHierarchyElement) {
        // заполнение новой страницы свойствами
        $newElement->setValue('h1', $newElementName);
        $newElement->setValue('title', $newElementName);
        $newElement->setValue('meta_descriptions', $newElementMetaDesc);
        $newElement->setValue('description', $newElementContent);
        $newElement->setValue('photo', $newElementImg);
        $newElement->setValue('price', $newElementPrice);

        // укажем, что страница активна
        $newElement->setIsActive(true);

        $newElement->commit();

        // адрес новой страницы
        echo 'успешно создана страница: "', $hierarchy->getPathById($newElementId), '"';
        echo $newElement->getValue('photo');
        echo 111;
    } else {
        echo 'не удалось получить экземпляр страницы #{$newEllementId}';
    }