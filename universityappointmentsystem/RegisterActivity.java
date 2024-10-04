package com.example.universityappointmentsystem;

import android.os.Bundle;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import androidx.appcompat.app.AppCompatActivity;

public class RegisterActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);


        EditText inputStudentNo = findViewById(R.id.inputStudentNo);
        EditText inputPassword = findViewById(R.id.inputPassword);
        EditText inputEmail = findViewById(R.id.inputEmail);
        EditText inputDepartment = findViewById(R.id.inputDepartment);
        Button buttonSignUp = findViewById(R.id.button2);
        TextView alreadyHaveAccount = findViewById(R.id.alreadyhaveaccount);


        buttonSignUp.setOnClickListener(v -> handleSignUp(inputStudentNo, inputPassword, inputEmail, inputDepartment));


        alreadyHaveAccount.setOnClickListener(v -> {
            // Here you can handle navigation to the login activity
            Toast.makeText(RegisterActivity.this, "Navigate to Login", Toast.LENGTH_SHORT).show();
        });
    }

    private void handleSignUp(EditText inputStudentNo, EditText inputPassword, EditText inputEmail, EditText inputDepartment) {

        String studentNo = inputStudentNo.getText().toString().trim();
        String password = inputPassword.getText().toString().trim();
        String email = inputEmail.getText().toString().trim();
        String department = inputDepartment.getText().toString().trim();


        if (studentNo.isEmpty() || password.isEmpty() || email.isEmpty() || department.isEmpty()) {
            Toast.makeText(this, "Please fill in all fields", Toast.LENGTH_SHORT).show();
            return;
        }


        Toast.makeText(this, "Sign Up Successful", Toast.LENGTH_SHORT).show();


        inputStudentNo.setText("");
        inputPassword.setText("");
        inputEmail.setText("");
        inputDepartment.setText("");
    }
}

