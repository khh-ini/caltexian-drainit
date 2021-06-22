package com.azizapp.test.ui.tentang_kami

import android.graphics.drawable.ColorDrawable
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.core.content.ContextCompat
import com.azizapp.test.R

class ActivityTentangKami : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_tentang_kami)

        supportActionBar?.setDisplayHomeAsUpEnabled(true)
        supportActionBar?.title = "Tentang Kami"
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return super.onSupportNavigateUp()
    }
}