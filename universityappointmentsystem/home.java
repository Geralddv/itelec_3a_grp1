package com.example.universityappointmentsystem;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import androidx.appcompat.app.AppCompatActivity;

public class home extends AppCompatActivity {

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

        // Set onClickListeners for each button
        btnCITEC.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to CITECActivity
                Intent intent = new Intent(home.this, CitecAppointment.class);
                startActivity(intent);
            }
        });

        btnCEAS.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to CEASActivity
                Intent intent = new Intent(home.this, CeasAppointment.class);
                startActivity(intent);
            }
        });

        btnCMT.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to CMTActivity
                Intent intent = new Intent(home.this, CmtAppointment.class);
                startActivity(intent);
            }
        });

        btnCCJE.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to CCJEActivity
                Intent intent = new Intent(home.this, CcjeAppointment.class);
                startActivity(intent);
            }
        });

        btnCENAR.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                // Navigate to CENARActivity
                Intent intent = new Intent(home.this, CenarAppointment.class);
                startActivity(intent);
            }
        });
    }
}