package com.glomindz.crimatrix;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.Bundle;
import android.support.v7.app.ActionBar;
import android.support.v7.app.AppCompatActivity;

/**
 * An example full-screen activity that shows and hides the system UI (i.e.
 * status bar and navigation/system bar) with user interaction.
 */
public class SplashActivity extends AppCompatActivity {


    String is_already_login;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_splash);

        delay();

    }

    private void delay() {

        SharedPreferences start_language_settings_prefs = getSharedPreferences(
                "login_info", MODE_PRIVATE);
        is_already_login = start_language_settings_prefs.getString(
                "is_already_login", "no");

        final int welcomeScreenDisplay = 2000;
        /** create a thread to show splash up to splash time */
        Thread welcomeThread = new Thread() {
            int wait = 0;

            @Override
            public void run() {
                try {
                    super.run();
                    /**
                     * use while to get the splash time. Use sleep() to increase
                     * the wait variable for every 100L.
                     */
                    while (wait < welcomeScreenDisplay) {
                        sleep(100);
                        wait += 100;
                    }
                } catch (Exception e) {
                    System.out.println("EXc=" + e);
                } finally {
                    if (is_already_login.equalsIgnoreCase("yes")) {
                        Intent user_details_intent = new Intent(
                                getApplicationContext(), MainActivity.class);
                        startActivity(user_details_intent);
                        // finish();
                    } else {
                        Intent login_intent = new Intent(
                                getApplicationContext(), GoogleSignInActivity.class);
                        startActivity(login_intent);
                        // finish();
                    }
                }
            }
        };
        welcomeThread.start();

    }

    @Override
    protected void onPostCreate(Bundle savedInstanceState) {
        super.onPostCreate(savedInstanceState);

        // Trigger the initial hide() shortly after the activity has been
        // created, to briefly hint to the user that UI controls
        // are available.
        hide();
    }


    private void hide() {
        // Hide UI first
        ActionBar actionBar = getSupportActionBar();
        if (actionBar != null) {
            actionBar.hide();
        }

    }
}
