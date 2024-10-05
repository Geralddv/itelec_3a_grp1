package com.example.appointment_system;//atches your package name

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;  // Import AppCompatActivity


public class notification extends AppCompatActivity {  // Extend AppCompatActivity
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.notification);  // This links to activity_citec.xml
    }
}
