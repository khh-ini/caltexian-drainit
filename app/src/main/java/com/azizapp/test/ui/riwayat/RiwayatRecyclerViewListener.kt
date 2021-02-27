package com.azizapp.test.ui.riwayat

import android.provider.ContactsContract
import android.view.View
import com.azizapp.test.model.Pengaduan

interface RiwayatRecyclerViewListener {
    fun onRecyclerViewItemClick(view: View, pengaduan: Pengaduan)
}