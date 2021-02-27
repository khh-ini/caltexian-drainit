package com.azizapp.test.ui.riwayat

import android.os.Bundle
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentEditProfileBinding
import com.azizapp.test.databinding.FragmentRiwayatBinding
import com.azizapp.test.ui.profile.EditProfileViewModel
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class DetilRiwayat : AppCompatActivity() {

    lateinit var binding: FragmentRiwayatBinding
    private val riwayatViewModel: RiwayatViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_detil_riwayat)
//        binding = DataBindingUtil.setContentView(this, R.layout.activity_detil_riwayat)
//
//        binding.apply {
//            lifecycleOwner = this@DetilRiwayat
//            viewModel = riwayatViewModel
//        }
//        riwayatViewModel.onLoad()
    }
}