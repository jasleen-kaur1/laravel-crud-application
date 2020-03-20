<?php

namespace App\Http\Controllers;

// Import the Users model
use App\Users;
use App\Charts\UserChart;
use Illuminate\Http\Request;
use DB;

// Controller class available from Laravel - defines a bunch of methods which will be used to do the CRUD operations against the Users model
// The routes are used to serve HTML templates and API endpoints when working with the Users model

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     * GET/users - used to serve the HTML form used to submit the user to POST/users
     *Implementing the read operation to get and display users from the MySQL database
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $borderColors = [
            "rgba(255, 99, 132, 1.0)",
            "rgba(22,160,133, 1.0)",
            "rgba(255, 205, 86, 1.0)",
            "rgba(51,105,232, 1.0)",
            "rgba(244,67,54, 1.0)",
            "rgba(34,198,246, 1.0)",
            "rgba(153, 102, 255, 1.0)",
            "rgba(255, 159, 64, 1.0)",
            "rgba(233,30,99, 1.0)",
            "rgba(205,220,57, 1.0)"
        ];
        $fillColors = [
            "rgba(255, 99, 132, 0.2)",
            "rgba(22,160,133, 0.2)",
            "rgba(255, 205, 86, 0.2)",
            "rgba(51,105,232, 0.2)",
            "rgba(244,67,54, 0.2)",
            "rgba(34,198,246, 0.2)",
            "rgba(153, 102, 255, 0.2)",
            "rgba(255, 159, 64, 0.2)",
            "rgba(233,30,99, 0.2)",
            "rgba(205,220,57, 0.2)"

        ];

        // Returns all users in the Users model, the Users data
        $users = Users::all();

        // Each user and their age
        $user_age = DB::table('users')
            ->select('name', 'age')
            ->pluck('age', 'name');

        // Create bar chart of each user with their age (shown in example)
        $user_age_chart = new UserChart;
        $user_age_chart->labels($user_age->keys());
        $user_age_chart->dataset('Age', 'bar', $user_age->values())
                        ->backgroundColor('#779ECB');
        $user_age_chart
                        ->title('Graph of Users and Their Ages', 18,'#666',true,"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
                        ->minimalist(false);

        // Age distribution
        $group_by_age = DB::table('users')
             ->select('age', DB::raw('count(*) as total'))
             ->groupBy('age')
             ->orderBy('age')
             ->pluck('total','age');         
        
        // Create bar chart grouping ages
        $group_by_age_chart = new UserChart;
        $group_by_age_chart->labels($group_by_age->keys());
        $group_by_age_chart->dataset('Number of users', 'bar', $group_by_age->values())
                            ->backgroundColor('#77DD77');
        $group_by_age_chart
                            ->title('Graph of Age Distribution of Users', 18,'#666',true,"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
                            ->minimalist(false);

        // City distribution
        $group_by_city = DB::table('users')
             ->select('city', DB::raw('count(*) as total'))
             ->groupBy('city')
             ->orderBy('city')
             ->pluck('total','city');

        // Create doughnut hole chart grouping cities
        $group_by_city_chart = new UserChart;
        $group_by_city_chart->labels($group_by_city->keys());
        $group_by_city_chart->dataset('Number of users', 'doughnut', $group_by_city->values())
                            ->backgroundColor('#77DD77')
                            ->color($borderColors)
                            ->backgroundcolor($fillColors);
         $group_by_city_chart
                            ->title('Pie Chart of Cities Distribution of Users', 18,'#666',true,"'Helvetica Neue', 'Helvetica', 'Arial', sans-serif")
                            ->minimalist(false)                    
                            ->displayAxes(false);
        
        // view() method returns the index.blade.php template
        // compact() is a PHP function - creates an array containing variables and their values
        // compact takes each attribute and value eg. ['name' => 'John Doe', 'email' => 'johndoe@gmail.com', 'age'=>'23']
        // Helps pass variables from controller to view 
        return view('users.index', compact('users', 'user_age_chart', 'group_by_age_chart', 'group_by_city_chart'));
    }

    /**
     * Show the form for creating a new resource.
     * GET/users/create
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // view() method returns the create.blade.php template
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     * POST/users -used to create a user in the database
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'age'=>'required',
            'job_title'=>'required',
            'city'=>'required'
        ]);

        // Creating a new record to insert into the database
        // getting all attributes from the form
        $user = new Users([
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'age' => $request->get('age'),
            'job_title' => $request->get('job_title'),
            'city' => $request->get('city')
        ]);

        // save is an equivalent of insert in sql, creates a new record in the database
        $user->save();
        return redirect('/users')->with('success', 'User saved!');
    }

    /**
     * Display the specified resource.
     * GET/users/{user}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     * GET/users/{user}/edit
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // find method returns a model matching the primary key
        $user = Users::find($id);
        return view('users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     * PUT/PATCH/users/{user}
     * update the record in the database
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'=>'required',
            'email'=>'required',
            'age'=>'required',
            'job_title'=>'required',
            'city'=>'required'
        ]);

        $user = Users::find($id);
        $user->name = $request->get('name');
        $user->email = $request->get('email');
        $user->age = $request->get('age');
        $user->job_title = $request->get('job_title');
        $user->city = $request->get('city');

        $user->save();

        return redirect('/users')->with('success', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE/users/{user}
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Users::find($id);
        $user->delete();
        return redirect('/users')->with('success', 'User deleted!');
    }
}
