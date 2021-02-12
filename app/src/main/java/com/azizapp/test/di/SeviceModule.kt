package com.azizapp.test.di

import com.azizapp.test.api.MasyarakatService
import dagger.Module
import dagger.Provides
import dagger.hilt.InstallIn
import dagger.hilt.android.components.ApplicationComponent
import retrofit2.Retrofit
import javax.inject.Singleton

@Module
@InstallIn(ApplicationComponent::class)
object ServiceModule {

    @Singleton
    @Provides
    fun provideMasyarakatService(retrofit: Retrofit) = retrofit.create(MasyarakatService::class.java)

}