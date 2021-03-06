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
                 Route::post('/out','admins\AdminController@userlogout');

             }

);

Route::group([ 'prefix' =>'/students',
             [ 'middleware' =>'auth_users','jwt.auth' ]],function()
             {
        Route::post('/register','students\Auth\RegisterController@register');
        Route::get('/login','students\Auth\LoginController@login');
        Route::get('/','students\StudentController@index');
        Route::get('/me','students\StudentController@usercheck');
        Route::post('/out','students\StudentController@userlogout');
        Route::get('/{s_id}/show',  'students\StudentController@show');
        Route::get('/edit/{s_id}', 'students\Auth\RegisterController@edit');
        Route::post('/{s_id}','students\Auth\RegisterController@update');
        Route::delete('/{s_id}','students\StudentController@destroy');
        Route::get('/show_exams/{student}','students\StudentController@show_exams');
        Route::get('/show_exam_rule/{id}','students\StudentController@show_exam_rule');
        Route::get('/show_questions/{exam}','students\StudentController@show_questions');


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
 Route::post('/{faculty_head_id}','facultyheads\FacultyHeadController@update');
 Route::get('/me','facultyheads\FacultyHeadController@usercheck');

 
 Route::post('/out','facultyheads\FacultyHeadController@userlogout');

 Route::delete('/{faculty_head_id}','facultyheads\FacultyHeadController@destroy');





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
             Route::post('/{faculty_id}','faculty\FacultyController@update');
             Route::delete('/{faculty_id}','faculty\FacultyController@destroy');
             Route::post('/out','faculty\FacultyController@userlogout');



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

             Route::post('/{sub_admin_id}','sub_admins\SubAdminController@update');


             Route::delete('/{sub_admin_id}','sub_admins\SubAdminController@destroy');
             Route::post('/out','sub_admins\SubAdminController@userlogout');
             Route::get('/me', 'sub_admins\SubAdminController@usercheck');
             Route::get('/showstudentsdetails/{centre}','sub_admins\SubAdminController@get_student_details');
            Route::get('/showfacultydetails/{centre}','sub_admins\SubAdminController@get_faculty_details');

             }

);



Route::group([ 'prefix' =>'/courses',
            ],function()
             {
 Route::post('/register','courses\RegisterCourseController@register');
 Route::get('/show/{course_id} ',  'courses\CourseUpdateController@show');
 Route::get('/edit/{course_id}', 'courses\CourseUpdateController@edit');
 Route::post('/{course_id}','courses\CourseUpdateController@update');
 Route::delete('/{course_id}','courses\CourseUpdateController@destroy');
 Route::get('/',           'courses\CourseUpdateController@index');
 Route::get('/showsub/{course_id}','courses\CourseUpdateController@get_sub');
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
                Route::post('/{class_id}','classes\ClassesUpdateController@update');
                Route::delete('/{class_id}','classes\ClassesUpdateController@destroy');
                Route::get('/',   'classes\ClassesUpdateController@index');
                Route::get('/{class_centre_name}','classes\ClassesUpdateController@detail');



             }

);



Route::group([ 'prefix' =>'/centres',
            ],function()
             {
         Route::post('/register','centres\RegisterCentreController@register');
         Route::get('/show/{centre_id} ',  'centres\CentreUpdateController@show');
         Route::get('/edit/{centre_id}', 'centres\CentreUpdateController@edit');
         Route::post('/{centre_id}','centres\CentreUpdateController@update');
         Route::delete('/{centre_id}','centres\CentreUpdateController@destroy');
         Route::get('/',  'centres\CentreUpdateController@index');
                // Route::post('/login','classes\LoginController@login');
             }

);




Route::group([ 'prefix' =>'/subjects',
            ],function()
             {
                 Route::post('/register','subjects\UpdateSubjectController@register');
                 Route::get('/{id}/show',  'subjects\UpdateSubjectController@show');
                 Route::get('/{id}/edit', 'subjects\UpdateSubjectController@edit');
                 Route::post('/{id}','subjects\UpdateSubjectController@update');

                 Route::get('/','subjects\UpdateSubjectController@index');
                // Route::post('/login','classes\LoginController@login');
                 Route::get('/stream/{stream_name}','subjects\UpdateSubjectController@getSubjects');
                 Route::delete('/{subject}','subjects\UpdateSubjectController@destroy');
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
     Route::get('/show_sub_topic/{sub_id}','topics\UpdateTopicController@show_sub_topic');
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
    Route::post('/addexam','exams\ExaminationController@addexam');
    Route::get('/','exams\ExaminationController@index');
    Route::get('/{exam}/edit', 'exams\ExaminationController@edit_exam');
    // Route::get('/{exam}','exams\ExaminationController@get_question');
    Route::post('/{exam}/update','exams\ExaminationController@update');
    
    Route::delete('/{exam}/delete','exams\ExaminationController@destroy');
    Route::post('/{exam}/deactivate','exams\ExaminationController@deactivate_exam');
    
    Route::post('/{exam}/addquestions', 'exams\QuestionController@add_question');
    Route::get('/{exam}/question/', 'exams\QuestionController@show_question');
   Route::get('/edit/question/{question}','exams\QuestionController@edit_question');
   Route::post('/update/question/{question}','exams\QuestionController@update_question');
   Route::delete('/question/{question}','exams\QuestionController@delete_question');
   Route:: get('/gettopics/{exam}','exams\ExaminationController@get_topics');
   Route::get('/getallid','exams\ExaminationController@getid');

             }

);


Route::group([ 'prefix' =>'/results',
            ],function()
             {
             Route::post('/{exam_id}/create','result\ResultController@create');
             Route::post('/{exam}/check','result\ResultController@check');
             }

);

Route::group([ 'prefix' =>'/materials',
            ],function()
             {
                Route::post('add', 'materials\StudyMaterialsController@add');
                Route::get('show/{id}', 'materials\StudyMaterialsController@show');
                Route::post('update/{id}', 'materials\StudyMaterialsController@update');
                Route::delete('delete/{id}', 'materials\StudyMaterialsController@destroy');
                Route::get('{sub_name}', 'materials\StudyMaterialsController@showall'); 

             }
 );            

 Route::group([ 'prefix' =>'/attendence',] ,function()
             {
                
                Route::get('/centre/{center_name}', 'Attendence\AttendenceController@getclasses');
                Route::post('/students', 'Attendence\AttendenceController@getstudents');
                Route::post('/attendence', 'Attendence\AttendenceController@add');
                Route::post('/index','Attendence\AttendenceController@index');
                Route::post('/show','Attendence\AttendenceController@show');
               

             }

);
