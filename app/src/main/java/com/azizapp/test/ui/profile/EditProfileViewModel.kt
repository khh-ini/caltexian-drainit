package com.azizapp.test.ui.profile

import android.se.omapi.Session
import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import com.azizapp.test.model.Masyarakat
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.ui.login.LoginViewModel
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session.bearer
import androidx.lifecycle.viewModelScope
import com.azizapp.test.R
import kotlinx.android.synthetic.main.fragment_edit_profile.view.*
import kotlinx.coroutines.launch

class EditProfileViewModel @ViewModelInject constructor(
    public val repository: MainRepository
) : ViewModel() {

    val loadingEnable = MutableLiveData<Boolean>()
    var nama = MutableLiveData<String>()
    val noHp = MutableLiveData<String>()
    val emailUser = MutableLiveData<String>()
    val alamat = MutableLiveData<String>()

    fun onLoad() {
        val bearer: String? = com.azizapp.test.utill.Session.bearer
        viewModelScope.launch {
            when (val response = bearer?.let { repository.getMasyarakatData(it) }) {
                is Resource.Success -> {
                    nama.postValue(response.data?.nama)
                    noHp.postValue(response.data?.noHp)
                    emailUser.postValue(response.data?.email)
                    alamat.postValue(response.data?.alamat)
                }
                is Resource.Error -> {
                    loadingEnable.postValue(false)
                    // action.postValue(LoginViewModel.ACTION_LOGIN_ERROR)
                }
            }
        }
    }

}

