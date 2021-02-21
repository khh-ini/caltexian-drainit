package com.azizapp.test.ui.laporan

import android.graphics.Color
import android.os.Bundle
import android.view.LayoutInflater
import android.view.View
import android.view.ViewGroup
import android.widget.*
import androidx.appcompat.widget.AppCompatSpinner
import androidx.fragment.app.Fragment
import com.azizapp.test.R
import com.google.android.material.bottomsheet.BottomSheetBehavior
import com.google.android.material.bottomsheet.BottomSheetDialog
import kotlinx.android.synthetic.main.bottom_sheet_dialog.*
import kotlinx.android.synthetic.main.bottom_sheet_dialog.view.*
import kotlinx.android.synthetic.main.fragment_laporan.*
import java.lang.StringBuilder


class LaporanFragment : Fragment() {

    private lateinit var jenisPengaduan: String

    override fun onCreateView(
        inflater: LayoutInflater, container: ViewGroup?,
        savedInstanceState: Bundle?
    ): View? {
        // Inflate the layout for this fragment
        pilihLaporan()
        val i = inflater.inflate(R.layout.fragment_laporan, container, false)
        tv_laporkan?.setText("Laporkan " + jenisPengaduan)
        return i
    }

    fun pilihLaporan() {
        val view = layoutInflater.inflate(R.layout.bottom_sheet_dialog, null)
        val dialog = BottomSheetDialog(requireActivity())
        dialog.setContentView(view)
        dialog.show()

        view.titik_tersumbat.setOnClickListener{
            jenisPengaduan = "Titik Tersumbat"
            Toast.makeText(
                        activity,
                        "Anda melaporkan Titik Tersumbat", Toast.LENGTH_SHORT
                    ).show()
            dialog.dismiss()
        }

        view.titik_banjir.setOnClickListener{
            jenisPengaduan = "Titik Banjir"
            Toast.makeText(
                activity,
                "Anda melaporkan Titik Banjir", Toast.LENGTH_SHORT
            ).show()
            dialog.dismiss()
        }
    }
}