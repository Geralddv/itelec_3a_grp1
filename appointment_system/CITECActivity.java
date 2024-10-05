package com.example.appointment_system;

import android.os.Bundle;
import androidx.appcompat.app.AppCompatActivity;
import android.app.DatePickerDialog;
import android.app.TimePickerDialog;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import java.util.Calendar;

public class CITECActivity extends AppCompatActivity {

    private Spinner spinnerTeachers;
    private EditText editTextPurpose;
    private TextView textViewDate, textViewTime;
    private Button buttonSetDate, buttonSetTime, buttonSubmit;

    private String selectedTeacher;
    private String selectedDate = "No date set";
    private String selectedTime = "No time set";

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_citec);

        spinnerTeachers = findViewById(R.id.spinner_teachers);
        editTextPurpose = findViewById(R.id.editText_purpose);
        textViewDate = findViewById(R.id.textView_date);
        textViewTime = findViewById(R.id.textView_time);
        buttonSetDate = findViewById(R.id.button_set_date);
        buttonSetTime = findViewById(R.id.button_set_time);
        buttonSubmit = findViewById(R.id.button_submit);

        // Set up the spinner with teacher options
        ArrayAdapter<CharSequence> adapter = ArrayAdapter.createFromResource(this, R.array.teachers_array, android.R.layout.simple_spinner_item);
        adapter.setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        spinnerTeachers.setAdapter(adapter);

        spinnerTeachers.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view, int position, long id) {
                selectedTeacher = parent.getItemAtPosition(position).toString();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                selectedTeacher = null;
            }
        });

        // Set date listener
        buttonSetDate.setOnClickListener(v -> showDatePicker());

        // Set time listener
        buttonSetTime.setOnClickListener(v -> showTimePicker());

        // Set submit button listener
        buttonSubmit.setOnClickListener(v -> submitAppointment());
    }

    private void showDatePicker() {
        Calendar calendar = Calendar.getInstance();
        int year = calendar.get(Calendar.YEAR);
        int month = calendar.get(Calendar.MONTH);
        int day = calendar.get(Calendar.DAY_OF_MONTH);

        DatePickerDialog datePickerDialog = new DatePickerDialog(this, (view, selectedYear, selectedMonth, selectedDay) -> {
            selectedDate = selectedDay + "/" + (selectedMonth + 1) + "/" + selectedYear;
            textViewDate.setText(selectedDate);
        }, year, month, day);
        datePickerDialog.show();
    }

    private void showTimePicker() {
        Calendar calendar = Calendar.getInstance();
        int hour = calendar.get(Calendar.HOUR_OF_DAY);
        int minute = calendar.get(Calendar.MINUTE);

        TimePickerDialog timePickerDialog = new TimePickerDialog(this, (view, selectedHour, selectedMinute) -> {
            selectedTime = selectedHour + ":" + String.format("%02d", selectedMinute);
            textViewTime.setText(selectedTime);
        }, hour, minute, true);
        timePickerDialog.show();
    }

    private void submitAppointment() {
        String purpose = editTextPurpose.getText().toString().trim();

        if (selectedTeacher == null || purpose.isEmpty() || selectedDate.equals("No date set") || selectedTime.equals("No time set")) {
            Toast.makeText(this, "Please fill all fields", Toast.LENGTH_SHORT).show();
        } else {
            // Submit the appointment (You can implement your own logic here)
            Toast.makeText(this, "Appointment set with " + selectedTeacher + " on " + selectedDate + " at " + selectedTime + " for: " + purpose, Toast.LENGTH_LONG).show();
        }
    }
}