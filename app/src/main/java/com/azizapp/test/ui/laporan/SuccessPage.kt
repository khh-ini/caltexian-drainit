package com.azizapp.test.ui.laporan

import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.azizapp.test.MainActivityNav
import com.azizapp.test.R
import kotlinx.android.synthetic.main.success_page.*

class SuccessPage : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.success_page)
        btnKembali.setOnClickListener(){
            val intent = Intent(this,MainActivityNav::class.java)
            startActivity(intent)
        }
    }
}