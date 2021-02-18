package com.azizapp.test.fragment

import android.content.Intent
import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.appcompat.widget.AppCompatSpinner
import androidx.fragment.app.Fragment
import com.azizapp.test.MainActivityNav
import com.azizapp.test.R
import com.azizapp.test.ui.laporan.LaporanActivity
import com.azizapp.test.ui.profile.ActivityEditProfile
import com.google.android.material.bottomsheet.BottomSheetBehavior
import com.google.android.material.bottomsheet.BottomSheetDialog
import kotlinx.android.synthetic.main.bottom_sheet_dialog.*
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import kotlinx.android.synthetic.main.fragment_laporan.*
import kotlinx.android.synthetic.main.fragment_laporan.view.*
import java.lang.StringBuilder


class LaporanFragment : Fragment() {

    private lateinit var jenisPengaduan: String

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        pilihLaporan()
        val inflater = inflater.inflate(R.layout.fragment_laporan, container, false)
        tv_laporkan?.setText("Laporkan $jenisPengaduan")

        inflater.til_nama_jalan.setOnClickListener {
            val intent = Intent(activity, LaporanActivity::class.java)
            startActivity(intent)
        }

        inflater.editTextNamaJalan.setOnClickListener {
            val intent = Intent(activity, LaporanActivity::class.java)
            startActivity(intent)
        }
        return inflater
    }

    fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(requireActivity())
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener{
            Toast.makeText(
                        activity,
                        "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
                    ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Tersumbat"
        }

        view.titik_banjir.setOnClickListener{
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
            jenisPengaduan = "Titik Banjir"
        }
    }
}