package com.azizapp.test.ui.timeline

import androidx.appcompat.app.AppCompatActivity
import android.os.Bundle
import com.azizapp.test.R
import com.azizapp.test.databinding.ActivityDetailTimelineBinding

class DetailTimelineActivity : AppCompatActivity() {

    private lateinit var binding:ActivityDetailTimelineBinding

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = ActivityDetailTimelineBinding.inflate(layoutInflater)
        setContentView(binding.root)

        setSupportActionBar(binding.toolbar)
        supportActionBar?.setDisplayHomeAsUpEnabled(true)

        val collapsingToolbarLayout = binding.collapsingToolbar
        collapsingToolbarLayout.title = "Detail Laporan"
    }

    override fun onSupportNavigateUp(): Boolean {
        onBackPressed()
        return super.onSupportNavigateUp()
    }
}