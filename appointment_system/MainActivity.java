package com.example.appointment_system;

import android.content.Intent;
import android.os.Bundle;
import android.widget.Button;
import android.widget.ImageButton;
import androidx.appcompat.app.AppCompatActivity;

public class MainActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.home);

        // Find buttons by their ID
        Button btnCITEC = findViewById(R.id.btncitec);
        Button btnCEAS = findViewById(R.id.btnceas);
        Button btnCMT = findViewById(R.id.btncmt);
        Button btnCCJE = findViewById(R.id.btnccje);
        Button btnCENAR = findViewById(R.id.btncenar);

        // Find image buttons by their ID
        ImageButton btnNotification = findViewById(R.id.btnNotification);
        ImageButton btnProfile = findViewById(R.id.btnProfile);

        // Set onClickListeners for each button
        btnCITEC.setOnClickListener(v -> {
            // Navigate to CITECActivity
            Intent intent = new Intent(MainActivity.this, CITECActivity.class);
            startActivity(intent);
        });

        btnCEAS.setOnClickListener(v -> {
            // Navigate to CEASActivity
            Intent intent = new Intent(MainActivity.this, CEASActivity.class);
            startActivity(intent);
        });

        btnCMT.setOnClickListener(v -> {
            // Navigate to CMTActivity
            Intent intent = new Intent(MainActivity.this, CMTActivity.class);
            startActivity(intent);
        });

        btnCCJE.setOnClickListener(v -> {
            // Navigate to CCJEActivity
            Intent intent = new Intent(MainActivity.this, CCJEActivity.class);
            startActivity(intent);
        });

        btnCENAR.setOnClickListener(v -> {
            // Navigate to CENARActivity
            Intent intent = new Intent(MainActivity.this, CENARActivity.class);
            startActivity(intent);
        });

        // Set onClickListeners for the image buttons
        btnNotification.setOnClickListener(v -> {
            // Handle notification button click
            // You can start a new activity or perform any other action here
        });

        btnProfile.setOnClickListener(v -> {
            // Handle profile button click
            // You can start a new activity or perform any other action here
        });
    }
}