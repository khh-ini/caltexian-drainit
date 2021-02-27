package com.azizapp.test.utill

import android.annotation.SuppressLint
import android.content.ContentResolver
import android.database.Cursor
import android.net.Uri
import android.provider.MediaStore
import android.provider.OpenableColumns
import android.view.View
import com.google.android.material.snackbar.Snackbar
import java.nio.file.Path


fun ContentResolver.getFileName(uri: Uri): String {
    var name = ""
    var cursor = query(uri, null, null, null, null)
    cursor?.use {
        it.moveToFirst()
        name = cursor.getString(it.getColumnIndex(OpenableColumns.DISPLAY_NAME))
    }
    return name
}

fun View.snackbar(message: String) {
    Snackbar.make(
        this,
        message,
        Snackbar.LENGTH_LONG
    ).also { snackbar ->
        snackbar.setAction("Ok") {
            snackbar.dismiss()
        }
    }.show()
}

fun ContentResolver.getRealPathFromURI(contentURI: Uri): String? {
    val result: String?
    val cursor: Cursor =  query(contentURI, null, null, null, null)!!

    cursor.use {
        result = run {
            cursor.moveToFirst()
            val idx: Int = cursor.getColumnIndex(MediaStore.Images.ImageColumns.DATA)
            cursor.getString(idx)
        }
    }

    return result
}