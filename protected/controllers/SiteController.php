<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{
    protected $p;

    public function init()
    {
/*        $p = new CHtmlPurifier();
        $p->options = array('URI.AllowedSchemes'=>array(
            'http' => true,
        ));*/
    }

    /**
     * Возвращает ошибку
     */
    public function actionError()
    {
        echo "Error:";
        print_r( Yii::app()->errorHandler->error );
    }

	/**
	 * Index action is the default action in a controller.
	 */
	public function actionIndex()
	{
		$this->render('index', [ ]);
	}

    /**
     * Первый шаг, получения ID
     */
    public function actionStart()
    {
        $out = [];
        $name = Yii::app()->request->getPost("name");
        //print_r( Yii::app()->request );
        if( !empty( $name ) )
        {
            $user = Users::model()->findByAttributes( ['name'=>$name] );
            if( sizeof( $user ) == 0 )
            {
                $newUser = new Users();
                $newUser->name = $name;
                if( $newUser->save() )
                {
                    $out["id"] = $newUser->id;
                    $out["question"] =  $this->getWord( );;
                }
                else
                    $out = ["error"=>"An error occured, try again"];
            }
                else $out = ["error"=>"Use a name already taken"];
        }
            else $out = ["error"=>"Name field is not filled"];

        echo json_encode( $out );
    }

    /**
     * Получение ответа
     *  - возвращает правильно или нет
     *  - новый вопрос
     *  - если конец, то общий результат
     */
    public function actionAnswer()
    {
        $userId = (int)Yii::app()->request->getQuery( "id", 0 );
        $wordId = (int)Yii::app()->request->getQuery( "wid", 0 );
        $answer = (int)Yii::app()->request->getQuery( "answer", 0 );
        $out = [];

        if( $userId >0 && $wordId>0 && $answer > 0 )
        {
            $userModel = Users::model()->findByAttributes( ['id' => $userId] );
            if( $userModel && $userModel->id>0 )
            {
                $wordModel = Words::model()->findByAttributes( ['id' => $wordId] );
                if( $wordModel && $wordModel->id >0 )
                {
                    if( $wordModel->id == $answer )
                    {
                        $userModel->count_ball ++;
                        $userModel->save();
                        $out["result"] = true;
                        $out["question"] = $this->getWord( $wordId );
                    }
                    else {
                        $out["result"] = false;
                        $badAnswer = BadAnswers::model()->findByAttributes(["word_id"=>$wordModel->id,"answer"=>$answer]);
                        if( !$badAnswer )
                        {
                            $newBadAnswer = new BadAnswers();
                            $newBadAnswer->word_id = $wordModel->id;
                            $newBadAnswer->answer = $answer;
                            $newBadAnswer->save();
                        }
                    }
                }
                else $out = ["error"=>"Указан неверный WID"];
            }
            else $out = ["error"=>"Указан неверный ID"];
        }
        else $out = ["error"=>"Не заполненны обязательные поля"];

        echo json_encode( $out );
    }

    /**
     * Возвращает вопрос с 4-я ответами
     */
    public function getWord( $lastWord = 0 )
    {
        $criteria = new CDbCriteria();
        if( $lastWord > 0 )
        {
            $criteria->condition = 'id > :id';
            $criteria->params = [':id' => $lastWord];
        }
        $criteria->order = 'id ASC';
        $words = Words::model()->find($criteria);

        if( $words && $words->id >0 )
        {
            $criteria = new CDbCriteria();
            $criteria->limit = 3;
            $criteria->condition = 'id != :id';
            $criteria->params = [ ':id' => $words->id ];
            $criteria->order = 'rand()';

            $otherWords = Words::model()->findAll( $criteria );
            $result["info"] = ["id"=>$words->id, "name"=>$words->name];
            $result["answers"] = [];
            $result["answers"][] = ["id"=>$words->id, "name"=>$words->translate ];

            for( $i=0;$i<sizeof($otherWords);$i++ )
                $result["answers"][] = ["id"=>$otherWords[$i]->id, "name"=>$otherWords[$i]->translate];

            shuffle( $result["answers"] );
            return $result;
        }
        return null;
    }
}

