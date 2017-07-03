Проект для создания REST API функционала. Построен по MVC-подобной архитектуре.
Разработан в качестве тестового задания за 42 рабочих часа или за 8 дней (3 из которых ПК разработчика был в ремонте).

<strong>
!!!ВАЖНО!!! Не используйте части кода данного проекта в продакшене, это тестовый проект.
</strong>


Пример добавление REST функционала:


///1. Добавляем роуты///

Расположение: src/RestApp/Config/config.yml

Разработчик отказался от параметров query, в пользу ЧПУ ссылок. Для определения параметров используюся обычные "регулярки".
Также их расположение в строке запроса влияет на порядок передаваемых в контроллер параметров.
В случае если введеный роут не найден, автоматически вызывается контроллер NofoundController с экшеном indexAction($uri),
поэтому этот контроллер есть по-умолчанию.

Пример добавления роута:
<pre>
  v1/apples/list: apples/list
</pre>
В данном примере справа находиться регулярка, слева контроллер/экшн


///2. Добавлением новую сущность и экшн в блок acl (access control list)//

В проекте предусмотрены 2 роли: guest и user. 

Пример добавления правила в acl:
 <pre> 
    apples
        guest: list[, some others actions]

    сущность
        роль: экшн(ы) через запятую

</pre>


///3. Создание контроллера///

Расположение: src/RestApp/Controllers/

Контроллеры строго именуются, например ApplesController (СущностьController)
То же самое относится к экшенам. Они именуются listAcion (экшн-с-маленькой-буквыAction)

Примеры контроллера и экшена:
<pre>

namespace MySimple\RestApp\Controllers;

use MySimple\RestApp\Core\Controllers\Controller;
use MySimple\RestApp\Views\View;


class ApplesController extends Controller
{
    public function listAction()
    {
        ... some code
    }
}
</pre>

///4. Создание модели///

Расположение: src/RestApp/Models

В качестве ORM использован SlimORM, т.к. по сути является очень удобной оберткой вокруг PDO.
Настройки соединения с БД также располагаются в config.yml
За формированием SQL-запросов разработчик просит обратиться к документации SlimPDO (https://github.com/FaaPz/Slim-PDO/tree/master/docs).

Для удобства постраничной навигации был написал DataProvider.
Пример:
<pre>
$provider = new DataProvider($this->db, self::class, array(
    'page'=>$page,
    'perPage'=>$perPage,
    'statement'=>$query
    ));

$provider->fetchAll();
</pre>
Пример модели вы найдете в папке Models


///5. Рендер выходных данных///

Расположение: src/RestApp/Views

Рендер осуществляется двух типов: JSON и XML

Примеры:
<pre>
$view = new View( new JsonReder() );
return $view->render($data);

$view = new View( new XmlRender() );
return $view->render($data);
</pre>
Вызов осуществляется в контроллере. Для автоматического определения типа рендеринга, у наследников класса Controller есть метод getRenderType().
Он определяет какой тип выбрать по хидеру Content-Type (application/json или application/xml).


///6. Пример экшена
<pre>
public function viewAction($id)
{
    $model = $this->loadModel($id);
    $view = new View($this->getRenderType());
    return $view->render($model->toArray());
}
</pre>

@TODO: 
1. Рефакторинг.
2. Добавить unit-тесты для внутренних модулей проекта
3. Написать об внутренней архитектуре проекта. 
... Продолжение следует

