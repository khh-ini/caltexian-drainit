package com.azizapp.test.ui.login

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.MediatorLiveData
import androidx.lifecycle.MutableLiveData
import androidx.lifecycle.ViewModel
import androidx.lifecycle.viewModelScope
import com.azizapp.test.model.Masyarakat
import com.azizapp.test.repository.MainRepository
import com.azizapp.test.utill.Resource
import com.azizapp.test.utill.Session
import kotlinx.coroutines.launch

class
LoginViewModel @ViewModelInject constructor(
    val repository: MainRepository
) : ViewModel() {

    companion object {
        const val ACTION_LOGIN_SUCCESS = "ACTION_SUCCESS"
        const val ACTION_LOGIN_FAILED = "ACTION_FAILED"
        const val ACTION_LOGIN_ERROR = "ACTION_ERROR"
    }

    val tvEmail = MutableLiveData<String>()
    val tvPassword = MutableLiveData<String>()

    val action = MutableLiveData<String>()

    val loadingEnable = MutableLiveData<Boolean>()

    fun btnLoginClick(){
        loadingEnable.value = true

        viewModelScope.launch {
            if (!tvEmail.value.isNullOrEmpty() && !tvPassword.value.isNullOrEmpty()){
                val masyarakat = Masyarakat(
                    email = tvEmail.value,
                    password = tvPassword.value
                )
                when(val response = repository.masyarakatLogin(masyarakat)){
                    is Resource.Success -> {
                        when(response.data?.statusCode){
                            200 -> {
                                loadingEnable.postValue(false)
                                Session.bearer = response.data.accessToken
                                action.postValue(ACTION_LOGIN_SUCCESS)
                            }
                            401 -> {
                                loadingEnable.postValue(false)
                                action.postValue(ACTION_LOGIN_FAILED)
                            }
                        }
                    }
                    is  Resource.Error -> {
                        loadingEnable.postValue(false)
                        action.postValue(ACTION_LOGIN_ERROR)
                    }
                }
            }
        }

    }

}

