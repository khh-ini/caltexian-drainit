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
import com.azizapp.test.ui.login.LoginActivity
import com.azizapp.test.ui.profile.ActivityEditProfile
import com.azizapp.test.utill.Session
import kotlinx.android.synthetic.main.fragment_profile.*

class ProfileFragment : Fragment() {
    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        val i = inflater.inflate(R.layout.fragment_profile, container, false)
        val ubahProfil : RelativeLayout = i.findViewById(R.id.ubahProfil)
        val gantiPassword : RelativeLayout = i.findViewById(R.id.ubahPassword)
        val keluar:RelativeLayout = i.findViewById(R.id.keluar)

        ubahProfil.setOnClickListener {
            val intent = Intent(activity, ActivityEditProfile::class.java)
            startActivity(intent)
        }

        gantiPassword.setOnClickListener {
            val intent = Intent(activity, EditPasswordActivity::class.java)
            startActivity(intent)
        }
        keluar.setOnClickListener{
            Session.bearer = ""
            val intent = Intent(activity, LoginActivity::class.java)
            startActivity(intent)
        }
        // Inflate the layout for this fragment
        return i
    }
}