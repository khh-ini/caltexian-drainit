package com.azizapp.test.ui.editpassword

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.EditMasyarakatRequest
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
    val action = MutableLiveData<String>()

    fun btnUbahPasswordClick() {
        val bearer: String = "Bearer " + com.azizapp.test.utill.Session.bearer

        viewModelScope.launch {
            if (newPwd.value.isNullOrEmpty() && confirmPwd.value.isNullOrEmpty()) {

            } else {
                val response = bearer.let { repository.getMasyarakatData(it) }
                val editMasyarakatRequest = EditMasyarakatRequest(
                    nama = response.data?.nama,
                    noHp = response.data?.noHp,
                    alamat = response.data?.alamat,
                    email = response.data?.email,
                    password = newPwd.value,
                    passwordConfirmation = confirmPwd.value,
                    foto = null,
                    method = "PUT"
                )
                when (val responseEdit =
                    bearer.let { repository.editPassword(it, editMasyarakatRequest) }) {
                    is Resource.Success -> {
                        if (responseEdit.data?.statusCode == 200) {
                           action.postValue(ACTION_EDIT_SUCCESS)
                        } else {
                           action.postValue(ACTION_EDIT_FAILED)
                        }
                    }
                    is Resource.Error -> {
                        action.postValue(ACTION_EDIT_ERROR)
                    }
                }
            }
        }
    }
}