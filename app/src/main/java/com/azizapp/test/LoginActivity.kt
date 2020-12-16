package com.azizapp.test

import android.content.Intent
import android.os.Bundle
import android.widget.Toast
import androidx.appcompat.app.AppCompatActivity
import androidx.databinding.DataBindingUtil
import androidx.lifecycle.Observer
import androidx.lifecycle.ViewModelProvider
import com.azizapp.test.databinding.ActivityLoginBinding

class LoginActivity : AppCompatActivity() {

    lateinit var binding: ActivityLoginBinding
    lateinit var loginViewModel: LoginViewModel

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        binding = DataBindingUtil.setContentView(this, R.layout.activity_login)
        loginViewModel = ViewModelProvider(this).get(LoginViewModel::class.java)

        binding.apply {
            lifecycleOwner = this@LoginActivity
            viewModel = loginViewModel
        }

        loginViewModel.action.observe(this, Observer { action ->
            when (action) {
                LoginViewModel.ACTION_LOGIN_SUCCESS -> loginSuccess()
            }
        })
    }

    private fun loginSuccess() {
        Toast.makeText(this, "Login Berhasil", Toast.LENGTH_SHORT).show()
        val intent = Intent(this, MainActivityNav::class.java)
        startActivity(intent)
    }

}