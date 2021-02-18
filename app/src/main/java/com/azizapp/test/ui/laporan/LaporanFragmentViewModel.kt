package com.azizapp.test.ui.laporan

import androidx.hilt.lifecycle.ViewModelInject
import androidx.lifecycle.ViewModel
import com.azizapp.test.repository.MainRepository
import dagger.hilt.android.AndroidEntryPoint

class LaporanFragmentViewModel @ViewModelInject constructor(
    val repository: MainRepository
):ViewModel() {
}