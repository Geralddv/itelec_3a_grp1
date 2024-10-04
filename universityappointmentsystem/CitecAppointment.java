package com.example.universityappointmentsystem;

import android.content.Intent;
import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;
import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;
import android.graphics.Color;

import java.util.Calendar;

public class CitecAppointment extends AppCompatActivity {
    private Spinner spinnerTeachers, spinnerPurpose;
    private TextView textViewDate, textViewTime;
    private Button buttonSetDate, buttonSetTime, buttonSubmit, cancelButton;

    private String selectedTeacher;
    private String selectedDate = "No date set";
    private String selectedTime = "No time set";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.citec_appoinment);

        initializeViews();
        setupSpinners();
        setListeners();
    }

    private void initializeViews() {
        spinnerTeachers = findViewById(R.id.spinner_teachers);
        spinnerPurpose = findViewById(R.id.spinner_purpose);
        textViewDate = findViewById(R.id.textView_date);
        textViewTime = findViewById(R.id.textView_time);
        buttonSetDate = findViewById(R.id.button_set_date);
        buttonSetTime = findViewById(R.id.button_set_time);
        buttonSubmit = findViewById(R.id.button_submit);
        cancelButton = findViewById(R.id.button_cancel);
    }

    private void setupSpinners() {
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this,
                R.array.teachers_array, R.layout.spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerTeachers.setAdapter(adapter);

        ArrayAdapter<CharSequence> purposeAdapter = ArrayAdapter.createFromResource(this,
                R.array.purposes_array, R.layout.spinner_item);
        purposeAdapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerPurpose.setAdapter(purposeAdapter);

        spinnerTeachers.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                selectedTeacher = position != 0 ? parent.getItemAtPosition(position).toString() : null;
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                selectedTeacher = null;
            }
        });
    }

    private void setListeners() {
        buttonSetDate.setOnClickListener(v -> showDatePicker());
        buttonSetTime.setOnClickListener(v -> showTimePicker());
        buttonSubmit.setOnClickListener(v -> submitAppointment());
        cancelButton.setOnClickListener(v -> {
            Intent intent = new Intent(CitecAppointment.this, home.class);
            startActivity(intent);
            finish();
        });
    }

    private void showDatePicker() {
        Calendar calendar = Calendar.getInstance();
        DatePickerDialog datePickerDialog = new DatePickerDialog(this, R.style.CustomDatePicker,
                (view, year, month, day) -> {
                    selectedDate = day + "/" + (month + 1) + "/" + year;
                    textViewDate.setText(selectedDate);
                    textViewDate.setTextColor(Color.BLACK);
                }, calendar.get(Calendar.YEAR), calendar.get(Calendar.MONTH), calendar.get(Calendar.DAY_OF_MONTH));

        datePickerDialog.getDatePicker().setMinDate(System.currentTimeMillis());
        datePickerDialog.show();
    }

    private void showTimePicker() {
        Calendar calendar = Calendar.getInstance();
        TimePickerDialog timePickerDialog = new TimePickerDialog(this, R.style.CustomTimePicker,
                (view, hour, minute) -> {
                    String amPm = hour >= 12 ? "PM" : "AM";
                    hour = hour % 12;
                    hour = hour == 0 ? 12 : hour; // Convert to 12-hour format
                    selectedTime = hour + ":" + String.format("%02d", minute) + " " + amPm;
                    textViewTime.setText(selectedTime);
                    textViewTime.setTextColor(Color.BLACK);
                }, calendar.get(Calendar.HOUR_OF_DAY), calendar.get(Calendar.MINUTE), false);

        timePickerDialog.show();
    }

    private void submitAppointment() {
        String purpose = spinnerPurpose.getSelectedItem().toString();

        if (selectedTeacher == null || purpose.equals("Purpose of appointment") || selectedDate.equals("No date set") || selectedTime.equals("No time set")) {
            Toast.makeText(this, "Please fill all fields", Toast.LENGTH_SHORT).show();
        } else {
            String confirmationMessage = "Appointment set with " + selectedTeacher + " on " + selectedDate + " at " + selectedTime + " for: " + purpose;
            Toast.makeText(this, confirmationMessage, Toast.LENGTH_LONG).show();
        }
    }
}
