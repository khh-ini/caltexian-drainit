package com.azizapp.test

import android.os.Bundle
import androidx.fragment.app.Fragment
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import androidx.appcompat.app.AppCompatActivity
import androidx.core.view.isInvisible
import kotlinx.android.synthetic.main.fragment_edit_profile.*

class fragment_editProfile : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_edit_profile)
        // Inflate the layout for this fragment

        ibNama.setOnClickListener{
            tvNamaUser.visibility = View.INVISIBLE
            editTextNama.visibility = View.VISIBLE
            ibNama.visibility = View.INVISIBLE
        }

        ibNoHp.setOnClickListener{
            tvNoHpUser.visibility = View.INVISIBLE
            editTextNoHp.visibility = View.VISIBLE
            ibNoHp.visibility = View.INVISIBLE
        }

        ibEmail.setOnClickListener{
            tvEmailUser.visibility = View.INVISIBLE
            editTextEmail.visibility = View.VISIBLE
            ibEmail.visibility = View.INVISIBLE
        }

        ibTempatLahir.setOnClickListener{
            tvTempatLahirUser.visibility = View.INVISIBLE
            editTextTempatLahir.visibility = View.VISIBLE
            ibTempatLahir.visibility = View.INVISIBLE
        }

        ibTanggalLahir.setOnClickListener{
            tvTanggalLahirUser.visibility = View.INVISIBLE
            editTextTanggalLahir.visibility = View.VISIBLE
            ibTanggalLahir.visibility = View.INVISIBLE
        }

        ibAlamat.setOnClickListener{
            tvAlamatUser.visibility = View.INVISIBLE
            editTextAlamat.visibility = View.VISIBLE
            ibAlamat.visibility = View.INVISIBLE
        }
    }
}