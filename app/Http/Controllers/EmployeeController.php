<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use Carbon\Carbon; // Add Carbon for date formatting

class EmployeeController extends Controller
{
    // Declare the employee model for use in controller methods
    protected $employee;

    // Constructor to initialize the employee model
    public function __construct(){
        $this->employee = new Employee();
    }

    // Display a list of all employees
    public function index()
    {
        // Retrieve all employees
        $response['employees'] = $this->employee->all();
        // Return the 'index' view with the employees data
        return view('pages.index')->with($response);
    }

    // Store a new employee in the database
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'emp_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|numeric|digits_between:10,15', // Ensure valid contact numbers
            'job_position' => 'required|string|max:255', // Make it required
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:employees,email',
            'salary' => 'required|numeric|min:0',
            'status' => 'required|in:0,1,2', // Updated for Active, Inactive, Pending
        ]);
    
        $validatedData['dob'] = Carbon::parse($request->dob)->format('Y-m-d');
        
        $this->employee->create($validatedData);
    
        return redirect()->route('employee.index')->with('success', 'Employee created successfully!');
    }
    

    // Show the form to edit an existing employee
    public function edit(string $id)
    {
        // Find the employee by ID
        $response['employee'] = $this->employee->find($id);

        // Return the edit view with the employee data
        return view('pages.edit')->with($response);
    }

    // Update an existing employee in the database
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'emp_name' => 'required|string|max:255',
            'dob' => 'required|date',
            'phone' => 'required|numeric|digits_between:10,15',
            'job_position' => 'required|string|max:255',
            'address' => 'nullable|string|max:255',
            'email' => 'required|email|unique:employees,email,' . $id,
            'salary' => 'required|numeric|min:0',
            'status' => 'required|in:0,1,2',
        ]);
    
        $employee = $this->employee->findOrFail($id);
        $employee->update($validatedData);
    
        return redirect()->route('employee.index')->with('success', 'Employee updated successfully!');
    }
    

    // Delete an employee from the database
    public function destroy(string $id)
    {
        // Find the employee by ID
        $employee = $this->employee->findOrFail($id);

        // Delete the employee
        $employee->delete();

        // Redirect to the employee list with success message
        return redirect()->route('employee.index')->with('success', 'Employee deleted successfully!');
    }
}
