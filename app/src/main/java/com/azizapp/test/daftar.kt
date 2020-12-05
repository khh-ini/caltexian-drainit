package com.azizapp.test

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import androidx.fragment.app.Fragment
import kotlinx.android.synthetic.main.splashscreen.*

/**
 * A simple [Fragment] subclass.
 * Use the [daftar.newInstance] factory method to
 * create an instance of this fragment.
 */
class daftar: AppCompatActivity() {

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_daftar)
    }
}