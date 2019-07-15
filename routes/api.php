 <?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


// Route::group([ 'prefix' =>'/auth',
//              [ 'middleware' =>'assign.guard:admins','jwt.auth' ]],function()
//              {
//                  Route::post('/register','Auth\RegisterController@register');
//                  Route::post('/login','Auth\LoginController@login');
//              }

// );

// Route::group([ 'prefix' =>'/auth',
//              [ 'middleware' =>'assign.guard:admins','jwt.auth' ]],function()
//              {
//                  Route::post('/register','Auth\RegisterController@register');
//                  Route::post('/login','Auth\LoginController@login');
//              }

// );


Route::group([ 'prefix' =>'/auth']
             ,function()
             {

                 Route::post('/login','AuthLoginController@loginRoute');
                 Route::get('/me', 'AuthLoginController@check_user');
             }

);

Route::group([ 'prefix' =>'/admins',
             [ 'middleware' =>'auth_users','jwt.auth']],function()
             {
                 Route::post('/register','admins\Auth\RegisterController@register');
                 Route::get('/login','admins\Auth\LoginController@login');
                 Route::get('/me','admins\AdminController@usercheck');

             }

);

Route::group([ 'prefix' =>'/students',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
                Route::post('/register','students\Auth\RegisterController@register');
                Route::get('/login','students\Auth\LoginController@login');
                Route::get('/','students\StudentController@index');
                Route::get('/me','students\StudentController@usercheck');
                // Route::post('/out','students\StudentController@userlogout');
                Route::get('/{s_id}/show',  'students\StudentController@show');
                Route::get('/edit/{s_id}', 'students\Auth\RegisterController@edit');
                Route::post('/update/{s_id}','students\Auth\RegisterController@update');
                Route::post('/{s_id}','students\StudentController@destroy');


                // Route::get('/show_exam/{student}','students\StudentController@show_exam');


             }

);
Route::group([ 'prefix' =>'/facultyheads',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
        Route::post('/register','facultyheads\FacultyHeadRegisterController@register');
        Route::get('/login','facultyheads\FacultyHeadLoginController@login');
         Route::get('/','facultyheads\FacultyHeadController@index');
         Route::get('/{faculty_head_id}/show',  'facultyheads\FacultyHeadController@show');
         Route::get('/edit/{faculty_head_id}', 'facultyheads\FacultyHeadController@edit');
         Route::post('/update/{faculty_head_id}','facultyheads\FacultyHeadController@update');
         Route::get('/me','facultyheads\FacultyHeadController@usercheck');
         Route::post('/{faculty_head_id}','facultyheads\FacultyHeadController@destroy');


                

             }

);


Route::group([ 'prefix' =>'/faculty',
             [ 'middleware' =>'jwt.auth' ]],function()
             {
             Route::post('/register','faculty\RegisterFacultyController@register');
             Route::get('/login','faculty\FacultyLoginController@login');
             Route::get('/','faculty\FacultyController@index');
             Route::get('/me','faculty\FacultyController@usercheck');
             Route::get('/{faculty_id}/show',  'faculty\FacultyController@show');
             Route::get('/edit/{faculty_id}', 'faculty\FacultyController@edit');
             Route::post('/update/{faculty_id}','faculty\FacultyController@update');
             Route::post('/{faculty_id}','faculty\FacultyController@destroy');
             

             }

);

// staffs to sub-admins
Route::group([ 'prefix' =>'/subadmins',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
             Route::post('/register','sub_admins\SubAdminRegisterController@register');
             Route::get('/login','sub_admins\SubAdminLoginController@login');
             // Route::get('/login','staffs\Auth\LoginController@login');
             Route::get('/me','sub_admins\SubAdminController@usercheck');
             Route::get('/','sub_admins\SubAdminController@index');

             Route::get('/{sub_admin_id}/show',  'sub_admins\SubAdminController@show');
             Route::get('/{sub_admin_id}/edit', 'sub_admins\SubAdminController@edit');

             Route::post('/{sub_admin_id}/update','sub_admins\SubAdminController@update');


             Route::post('/{sub_admin_id}','sub_admins\SubAdminController@destroy');

             }

);



Route::group([ 'prefix' =>'/courses',
            ],function()
             {
                 Route::post('/register','courses\RegisterCourseController@register');
                 Route::get('/show/{course_id} ',  'courses\CourseUpdateController@show');
                 Route::get('/edit/{course_id}', 'courses\CourseUpdateController@edit');
                 Route::post('/update/{course_id}','courses\CourseUpdateController@update');
                 Route::post('/{course_id}','courses\CourseUpdateController@destroy');
                 Route::get('/',           'courses\CourseUpdateController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);


//Route::group(['middleware' => 'cors'], function () {
Route::group([ 'prefix' =>'/classes',
            ],function()
             {
                Route::post('/register','classes\RegisterClassController@register');
                Route::get('/show/{class_id}',  'classes\ClassesUpdateController@show');
                Route::get('/edit/{class_id}', 'classes\ClassesUpdateController@edit');
                Route::post('/update/{class_id}','classes\ClassesUpdateController@update');
                Route::post('/{class_id}','classes\ClassesUpdateController@destroy');
                Route::get('/',           'classes\ClassesUpdateController@index');



             }

);



Route::group([ 'prefix' =>'/centres',
            ],function()
             {
                 Route::post('/register','centres\RegisterCentreController@register');
                 Route::get('/show/{centre_id} ',  'centres\CentreUpdateController@show');
                 Route::get('/edit/{centre_id}', 'centres\CentreUpdateController@edit');
                 Route::post('/update/{centre_id}','centres\CentreUpdateController@update');
                 Route::post('/{centre_id}','centres\CentreUpdateController@destroy');
                 Route::get('/',           'centres\CentreUpdateController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);




Route::group([ 'prefix' =>'/subjects',
            ],function()
             {
                 Route::post('/register','subjects\UpdateSubjectController@register');
                 Route::get('/{subject_id}/show',  'subjects\UpdateSubjectController@show');
                 Route::get('/{subject_id}/edit', 'subjects\UpdateSubjectController@edit');
                 Route::post('/{subject_id}','subjects\UpdateSubjectController@update');

                 Route::get('/','subjects\UpdateSubjectController@index');
                // Route::post('/login','classes\LoginController@login');
                 Route::get('/stream/{stream_name}','subjects\UpdateSubjectController@getSubjects');
             }

);


Route::group([ 'prefix' =>'/topics',
            ],function()
             {
                 Route::post('/register','topics\UpdateTopicController@register');
                 Route::get('/{topic_id}/show',  'topics\UpdateTopicController@show');
                 Route::get('/{topic_id}/edit', 'topics\UpdateTopicController@edit');
                 Route::post('/{topic_id}',     'topics\UpdateTopicController@update');

                 Route::get('/',           'topics\UpdateTopicController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);


Route::group([ 'prefix' =>'/streams',
            ],function()
             {
                 Route::post('/register','streams\UpdateStreamController@register');
                 Route::get('/{id}/show',  'streams\UpdateStreamController@show');
                 Route::get('/{id}/edit', 'streams\UpdateStreamController@edit');
                 Route::post('/{id}',     'streams\UpdateStreamController@update');

                 Route::get('/',           'streams\UpdateStreamController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);



Route::group([ 'prefix' =>'/exams',
            ],function()
             {
            Route::post('/{teacher}/addexam','exams\ExaminationController@addexam');
            Route::get('/','exams\ExaminationController@index');
            Route::get('/{exam}/edit', 'exams\ExaminationController@edit_exam');
            Route::get('/{exam}','exams\ExaminationController@get_question');
            Route::post('/{exam}/update','exams\ExaminationController@update');
            Route::get('/{teacher}/show_exam', 'exams\ExaminationController@show_exam');
            Route::get('/{exam}/delete','exams\ExaminationController@destroy');
            Route::post('/{exam}/deactivate','exams\ExaminationController@deactivate_exam');
            Route::get('/show_rules/{exam}','exams\ExaminationController@show_rules');




            Route::post('/{exam}', 'exams\QuestionController@add_question');
             Route::get('/question/{exam}', 'exams\QuestionController@show_question');
             Route::get('/edit/{question}','exams\QuestionController@edit_question');
             Route::post('/update/{question}','exams\QuestionController@update_question');
             Route::get('/delete_question/{question}','exams\QuestionController@delete_question');
             }

);

