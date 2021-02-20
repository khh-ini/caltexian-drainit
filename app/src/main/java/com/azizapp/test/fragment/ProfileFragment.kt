package com.azizapp.test.fragment

import android.content.Intent
import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.RelativeLayout
import com.azizapp.test.ActivityGantiPassword
import com.azizapp.test.R
import com.azizapp.test.ui.editpassword.EditPasswordActivity
import com.azizapp.test.ui.profile.ActivityEditProfile

class ProfileFragment : Fragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val i = inflater.inflate(R.layout.fragment_profile, container, false)
        val ubahProfil : RelativeLayout = i.findViewById(R.id.ubahProfil)
        val gantiPassword : RelativeLayout = i.findViewById(R.id.ubahPassword)

        ubahProfil.setOnClickListener {
            val intent = Intent(activity, ActivityEditProfile::class.java)
            startActivity(intent)
        }

        gantiPassword.setOnClickListener {
            val intent = Intent(activity, EditPasswordActivity::class.java)
            startActivity(intent)
        }
        // Inflate the layout for this fragment
        return i
    }
}