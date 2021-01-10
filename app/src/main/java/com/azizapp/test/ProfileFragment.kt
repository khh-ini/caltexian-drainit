package com.azizapp.test

import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.ImageButton
import android.widget.RelativeLayout
import android.widget.Spinner
import kotlinx.android.synthetic.main.fragment_daftar.*
import kotlinx.android.synthetic.main.fragment_profile.*

class ProfileFragment : Fragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val i = inflater.inflate(R.layout.fragment_profile, container, false)
        val ubahProfil : RelativeLayout = i.findViewById(R.id.ubahProfil)

        ubahProfil.setOnClickListener {
            val intent = Intent(activity, fragment_editProfile::class.java)
            startActivity(intent)
        }
        // Inflate the layout for this fragment
        return i
    }
}