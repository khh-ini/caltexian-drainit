package com.azizapp.test.ui.daftar

import android.content.Intent
import android.os.Bundle
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import androidx.lifecycle.Observer
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentDaftarBinding
import com.azizapp.test.ui.login.LoginActivity
import com.google.android.material.snackbar.Snackbar
import dagger.hilt.android.AndroidEntryPoint
import kotlinx.android.synthetic.main.activity_login.*
import kotlinx.android.synthetic.main.fragment_daftar.*

@AndroidEntryPoint
class DaftarActivity : AppCompatActivity() {
    lateinit var binding: FragmentDaftarBinding
    private val daftarViewModel: DaftarViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_daftar)
        binding = DataBindingUtil.setContentView(this, R.layout.fragment_daftar)

        binding.apply {
            lifecycleOwner = this@DaftarActivity
            viewModelDaftar = daftarViewModel
        }
        daftarViewModel.action.observe(this, Observer { action ->
            when (action) {
                DaftarViewModel.ACTION_DAFTAR_SUCCESS-> daftarSuccess()
                DaftarViewModel.ACTION_DAFTAR_ERROR->daftarError()
                DaftarViewModel.ACTION_DAFTAR_FAILED->daftarFailed()
            }

        })

        tvLinkMasuk.setOnClickListener{
            val intent = Intent(this, LoginActivity::class.java)
            startActivity(intent)
        }
    }

    private fun daftarFailed() {
        Snackbar.make(binding.root,"Daftar Error", Snackbar.LENGTH_SHORT).show()
    }

    private fun daftarError() {
        Snackbar.make(binding.root,"Daftar Gagal",Snackbar.LENGTH_SHORT).show()
    }

    private fun daftarSuccess() {
        Snackbar.make(binding.root,"Akun Anda Berhasil Dibuat!",Snackbar.LENGTH_SHORT).show()
    }
}