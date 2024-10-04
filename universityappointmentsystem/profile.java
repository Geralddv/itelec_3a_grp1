package com.example.universityappointmentsystem;

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;  // Import AppCompatActivity


public class profile extends AppCompatActivity {  // Extend AppCompatActivity
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.profile);  // This links to activity_citec.xml
    }
}