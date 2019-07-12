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
                 Route::post('/login','admins\Auth\LoginController@login');
             }

);

Route::group([ 'prefix' =>'/students',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
                Route::post('/register','students\Auth\RegisterController@register');
                // Route::get('/login','students\Auth\LoginController@login');
                // Route::get('/','students\StudentController@index');
                // Route::get('/me','students\StudentController@usercheck');
                // Route::post('/out','students\StudentController@userlogout');
                // Route::get('/{s_id}/show',  'students\StudentController@show');
                // Route::get('/{s_id}/edit', 'students\StudentController@edit');
                // Route::post('/{s_id}','students\StudentController@update');
                // Route::delete('/{s_id}','students\StudentController@destroy');


                // Route::get('/show_exam/{student}','students\StudentController@show_exam');


             }

);
// Change teacher to faculties
Route::group([ 'prefix' =>'/faculties',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
                 Route::post('/register','teachers\Auth\RegisterController@register');
                 Route::get('/login','teachers\Auth\LoginController@login');
                 Route::get('/me','teachers\TeacherController@usercheck');
                 Route::get('/{t_id}/show',  'teachers\TeacherController@show');
                 Route::get('/{t_id}/edit', 'teachers\TeacherController@edit');

                Route::post('/{t_id}','teachers\TeacherController@update');


                 Route::delete('/{t_id}','teachers\TeacherController@destroy');

                 Route::get('/','teachers\TeacherController@index');

                 Route::get('/{teacher}','teachers\TeacherController@get_exam');

             }

);

// staffs to sub-admins
Route::group([ 'prefix' =>'/sub-admins',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
                 Route::post('/register','staffs\Auth\RegisterController@register');
                 Route::get('/login','staffs\Auth\LoginController@login');
                Route::get('/me','staffs\StaffController@usercheck');
                 Route::get('/','staffs\StaffController@index');

                 Route::get('/{st_id}/show',  'staffs\StaffController@show');
                 Route::get('/{st_id}/edit', 'staffs\StaffController@edit');

                Route::post('/{st_id}','staffs\StaffController@update');


                 Route::delete('/{st_id}','staffs\StaffController@destroy');

             }

);

Route::group([ 'prefix' =>'/forum',
             ['middleware' =>'auth_users']],function()
             {

                 Route::post('/threads','forum\ThreadsController@store');
                 Route::get('/threads','forum\ThreadsController@index');
                 Route::get('/threads/{channel}','forum\ThreadsController@index');
                 Route::get('/channels','forum\ChannelsController@index');
                 Route::get('/channels/{channel}/','forum\ChannelsController@show');
                 Route::get('/threads/{channel}/{thread}','forum\ThreadsController@show');
                 Route::post('/threads/{channel}/{thread}/replies','forum\RepliesController@store');
                 Route::post('/replies/{reply}/saved','forum\SavedController@store');

             }

);



// Route::post('/register','api\classes\RegisterClassController@register');
// Route::post('/login','staffs\Auth\LoginController@login');


//Route::group(['middleware' => 'cors'], function () {
Route::group([ 'prefix' =>'/classes',
            ],function()
             {
                 Route::post('/register','classes\RegisterClassController@register');
                  Route::get('/{class_id}/show',  'classes\ClassesUpdateController@show');
                 Route::get('/{class_id}/edit', 'classes\ClassesUpdateController@edit');
                 Route::post('/{class_id}','classes\ClassesUpdateController@update');
                 Route::delete('/{sub_id}','classes\ClassesUpdateController@destroy');
                 Route::get('/',           'classes\ClassesUpdateController@index');



             }

);

Route::group([ 'prefix' =>'/courses',
            ],function()
             {
                 Route::post('/register','courses\RegisterCourseController@register');
                 Route::get('/{sub_id}/show',  'courses\CourseUpdateController@show');
                 Route::get('/{sub_id}/edit', 'courses\CourseUpdateController@edit');
                 Route::post('/{sub_id}','courses\CourseUpdateController@update');
                 Route::delete('/{sub_id}','courses\CourseUpdateController@destroy');
                 Route::get('/',           'courses\CourseUpdateController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);


Route::group([ 'prefix' =>'/backlog',
            ],function()
             {
                 Route::post('/register','backlog\InsertBacklogController@register');
                 // Route::get('/{sub_id}/show',  'courses\CourseUpdateController@show');
                 // Route::get('/{sub_id}/edit', 'courses\CourseUpdateController@edit');
                 // Route::post('/{sub_id}','courses\CourseUpdateController@update');
                 // Route::delete('/{sub_id}','courses\CourseUpdateController@destroy');
                 // Route::get('/',           'courses\CourseUpdateController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);


Route::group([ 'prefix' =>'/departments',
            ],function()
             {
                 Route::post('/register','Departments\UpdateDepartmentController@register');
                 Route::get('/{stream_id}/show',  'Departments\UpdateDepartmentController@show');
                 Route::get('/{stream_id}/edit', 'Departments\UpdateDepartmentController@edit');
                 Route::post('/{stream_id}','Departments\UpdateDepartmentController@update');

                 Route::get('/',           'Departments\UpdateDepartmentController@index');
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

