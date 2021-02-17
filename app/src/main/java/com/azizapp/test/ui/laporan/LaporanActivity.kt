package com.azizapp.test.ui.laporan

import android.app.PendingIntent.getActivity
import android.content.Intent
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.azizapp.test.fragment.MapFragment
import com.azizapp.test.R
import kotlinx.android.synthetic.main.activity_auth.*
import kotlinx.android.synthetic.main.fragment_nama_jalan.*

class LaporanActivity: AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_nama_jalan)

        btn_simpan.setOnClickListener {
            val intent = Intent(this, MapFragment::class.java)
            startActivity(intent)
        }
    }
}