package com.azizapp.test.ui.editpassword

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.MasyarakatDaftar
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.ui.daftar.DaftarViewModel
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import kotlinx.coroutines.launch

class EditPasswordViewModel @ViewModelInject constructor(
    public val repository: MainRepository
) : ViewModel() {

    companion object {
        const val ACTION_EDIT_SUCCESS = "EDIT_SUCCESS"
        const val ACTION_EDIT_FAILED = "EDIT_FAILED"
        const val ACTION_EDIT_ERROR = "EDIT_ERROR"
    }

    val newPwd = MutableLiveData<String>()
    val confirmPwd = MutableLiveData<String>()

    fun btnUbahPasswordClick() {
        viewModelScope.launch {
            if (newPwd.value.isNullOrEmpty() && confirmPwd.value.isNullOrEmpty()) {

            } else {
                val masyarakatDaftar = MasyarakatDaftar(
                    password = newPwd.value,
                    password_confirmation = confirmPwd.value,
                    foto = null
                )
                when (val response =
                    Session.bearer?.let { repository.editPassword(it, masyarakatDaftar) }) {
                    is Resource.Success -> {
                        if (response.data?.status_code == "201") {
                           // action.postValue(DaftarViewModel.ACTION_DAFTAR_SUCCESS)
                        } else {
//                            loadingEnable.postValue(false)
//                            action.postValue(DaftarViewModel.ACTION_DAFTAR_FAILED)
                        }
                    }
                    is Resource.Error -> {
//                        action.postValue(DaftarViewModel.ACTION_DAFTAR_ERROR)
                    }
                }
            }
        }
    }
}