package com.azizapp.test

import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import kotlinx.coroutines.*

class LoginViewModel : ViewModel() {

    companion object {
        const val ACTION_LOGIN_SUCCESS = "action_login_success"
    }

    val loadingEnabled = MutableLiveData<Boolean>()
    val action = MutableLiveData<String>()

    val tvEmail = MutableLiveData<String>()
    val tvPass = MutableLiveData<String>()

    fun masuk() {
        loadingEnabled.value = true
        viewModelScope.launch {
            delay(2000)
            loadingEnabled.postValue(false)
            action.postValue(ACTION_LOGIN_SUCCESS)
        }
    }

}