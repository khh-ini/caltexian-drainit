package com.azizapp.test.ui.profile

import android.os.Bundle
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import androidx.lifecycle.Observer
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentEditProfileBinding
import dagger.hilt.android.AndroidEntryPoint

@AndroidEntryPoint
class ActivityEditProfile : AppCompatActivity() {

    lateinit var binding: FragmentEditProfileBinding
    private val editProfileViewModel: EditProfileViewModel by viewModels()

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.fragment_edit_profile)
        binding = DataBindingUtil.setContentView(this, R.layout.fragment_edit_profile)

        binding.apply {
            lifecycleOwner = this@ActivityEditProfile
            viewModeEditProfile = editProfileViewModel
        }
        editProfileViewModel.onLoad()

    }
}