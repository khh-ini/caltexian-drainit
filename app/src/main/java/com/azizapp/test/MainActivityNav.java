package com.azizapp.test;

import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;

import androidx.annotation.Nullable;
import androidx.appcompat.app.AppCompatActivity;
import androidx.fragment.app.Fragment;
import androidx.fragment.app.FragmentManager;
import androidx.fragment.app.FragmentTransaction;
import com.azizapp.test.fragment.HomeFragment;
import com.azizapp.test.ui.laporan.LaporanFragment;
import com.azizapp.test.fragment.ProfileFragment;
import com.azizapp.test.fragment.RiwayatFragment;
import com.ismaeldivita.chipnavigation.ChipNavigationBar;

import dagger.hilt.android.AndroidEntryPoint;
import android.view.LayoutInflater;
import android.widget.EditText;

@AndroidEntryPoint
public class MainActivityNav extends AppCompatActivity {
    private static final String TAG = MainActivityNav.class.getSimpleName();
    private ChipNavigationBar mMainNav;
    private HomeFragment homeFragment;
    private ProfileFragment profileFragment;
    private RiwayatFragment riwayatFragment;
    private FragmentManager fragmentManager;
    private EditText editText;

    @Override
    protected void onCreate(@Nullable Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        mMainNav = findViewById(R.id.main_nav);

        if (getIntent().hasExtra("lat")&&getIntent().hasExtra("long")){
            mMainNav.setItemSelected(R.id.nav_new, true);
            fragmentManager = getSupportFragmentManager();
            LaporanFragment laporanFragment = new LaporanFragment();
            fragmentManager.beginTransaction()
                    .replace(R.id.main_frame, laporanFragment)
                    .commit();
        }
        if (savedInstanceState==null){
            mMainNav.setItemSelected(R.id.nav_home, true);
            fragmentManager = getSupportFragmentManager();
            HomeFragment homeFragment = new HomeFragment();
            fragmentManager.beginTransaction()
                    .replace(R.id.main_frame, homeFragment)
                    .commit();
        }
        if (getIntent().hasExtra("latLng")){
            mMainNav.setItemSelected(R.id.nav_new, true);
            fragmentManager = getSupportFragmentManager();
            LaporanFragment laporanFragment = new LaporanFragment();
            fragmentManager.beginTransaction()
                    .replace(R.id.main_frame, laporanFragment)
                    .commit();

            View view = View.inflate(this, R.layout.fragment_laporan, null);
            editText = (EditText)view.findViewById(R.id.editTextNamaJalan);
            editText.setText(getIntent().getStringExtra("latLng"));
        }

        mMainNav.setOnItemSelectedListener(new ChipNavigationBar.OnItemSelectedListener() {
            @Override
            public void onItemSelected(int id) {
                Fragment fragment = null;
                switch (id){
                    case R.id.nav_new:
                        fragment = new LaporanFragment();
                        break;
                    case R.id.nav_home:
                        fragment = new HomeFragment();
                        break;
                    case R.id.nav_history:
                        fragment = new RiwayatFragment();
                        break;
                    case R.id.nav_profile:
                        fragment = new ProfileFragment();
                        break;
                }

                if (fragment!=null){
                    fragmentManager = getSupportFragmentManager();
                    fragmentManager.beginTransaction()
                            .replace(R.id.main_frame, fragment)
                            .commit();
                } else {
                    Log.e(TAG, "Error in creating fragment");
                }
            }
        });
    }

    private void setFragment(Fragment fragment) {
        FragmentTransaction fragmentTransaction = getSupportFragmentManager().beginTransaction();
        fragmentTransaction.replace(R.id.main_frame, fragment);
        fragmentTransaction.commit();
    }
}
