package com.azizapp.test.ui.profile

import android.os.Bundle
import androidx.activity.viewModels
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import androidx.lifecycle.Observer
import com.azizapp.test.R
import com.azizapp.test.databinding.FragmentEditProfileBinding
import com.azizapp.test.ui.editpassword.EditPasswordViewModel
import com.google.android.material.snackbar.Snackbar
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

        editProfileViewModel.action.observe(this, Observer { action ->
            when (action) {
                EditPasswordViewModel.ACTION_EDIT_SUCCESS -> editSuccess()
                EditPasswordViewModel.ACTION_EDIT_ERROR -> editError()
                EditPasswordViewModel.ACTION_EDIT_FAILED -> editFailed()
            }
        })

    }

    private fun editFailed() {
        Snackbar.make(binding.root, "Edit Failed", Snackbar.LENGTH_SHORT).show()
    }

    private fun editError() {
        Snackbar.make(binding.root, "Edit Error", Snackbar.LENGTH_SHORT).show()
    }

    private fun editSuccess() {
        Snackbar.make(binding.root, "Edit Success", Snackbar.LENGTH_SHORT).show()
        editProfileViewModel.onLoad()
    }
}