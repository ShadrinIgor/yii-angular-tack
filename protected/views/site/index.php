<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta http-equiv="Content-Language" content="ru" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="themes/css/bootstrap.min.css" rel="stylesheet" />
        <link href="themes/css/style.css" rel="stylesheet" />
        <script>
            var baseUrl = '<?= Yii::app()->params['baseUrl'] ?>';
        </script>
    </head>
<body ng-app="main-ui">
    <div id="Main" ng-controller="main">
        <div class="panel panel-success">
            <div class="panel-heading">Прохождение теста</div>
            <div class="panel-body">
                <div class="alert alert-danger errorBlock displayNone"></div>
                <div class="alert alert-success okBlock displayNone"></div>
                <div class="panel panel-info step1">
                    <div class="panel-heading">Представьтесь пожалуйста</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="usr">Имя:</label>
                            <input type="text" required class="form-control" id="name" name="name" />
                        </div>
                        <div class="text-center">
                            <input type="button" class="btn btn-danger" ng-click="start()" value="Начать тест" />
                        </div>
                    </div>
                </div>
                <div class="panel panel-danger step2 displayNone">
                    <div class="panel-heading">Тут будет название вопроса?</div>
                    <div class="panel-body">
                        <div class="form-group">
                            <ul>
                                <li><input type="radio" name="answer" value="1" id="value_1" />&nbsp;<label for="value_1">Первый ответ</label></li>
                                <li><input type="radio" name="answer" value="2" id="value_2" />&nbsp;<label for="value_2">Первый ответ</label></li>
                                <li><input type="radio" name="answer" value="3" id="value_3" />&nbsp;<label for="value_3">Первый ответ</label></li>
                                <li><input type="radio" name="answer" value="4" id="value_4" />&nbsp;<label for="value_4">Первый ответ</label></li>
                            </ul>
                            <div ng-show="attempt>1">Попытка: <b>{{attempt}}</b></div>
                        </div>
                        <div class="text-right">
                            <input type="button" class="btn btn-danger" ng-click="nextQuestion()" value="Отправить >>" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default panelInfo displayNone">
            <div class="panel-heading">Предварительные результаты</div>
            <div class="panel-body">
                <div id="count">Пройденно тектов: <b>{{count}}</b></div>
                <div id="count">Количество баллов: <b>{{count_balls}}</b></div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="themes/js/jquery.js" ></script>
    <script type="text/javascript" src="themes/js/angular.js" ></script>
    <script type="text/javascript" src="themes/js/bootstrap.min.js" ></script>
    <script type="text/javascript" src="themes/js/functions.js" ></script>
</body>
</html>