package esame.pepper;

import android.app.ProgressDialog;
import android.content.Intent;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.TextView;

import java.util.ArrayList;
import java.util.Collections;
import java.util.List;

import com.aldebaran.qi.sdk.QiContext;
import com.aldebaran.qi.sdk.QiSDK;
import com.aldebaran.qi.sdk.RobotLifecycleCallbacks;
import com.aldebaran.qi.sdk.builder.ListenBuilder;
import com.aldebaran.qi.sdk.builder.PhraseSetBuilder;
import com.aldebaran.qi.sdk.builder.SayBuilder;
import com.aldebaran.qi.sdk.design.activity.RobotActivity;
import com.aldebaran.qi.sdk.design.activity.conversationstatus.SpeechBarDisplayPosition;
import com.aldebaran.qi.sdk.design.activity.conversationstatus.SpeechBarDisplayStrategy;
import com.aldebaran.qi.sdk.object.conversation.EditablePhraseSet;
import com.aldebaran.qi.sdk.object.conversation.Listen;
import com.aldebaran.qi.sdk.object.conversation.ListenResult;
import com.aldebaran.qi.sdk.object.conversation.Phrase;
import com.aldebaran.qi.sdk.object.conversation.PhraseSet;
import com.aldebaran.qi.sdk.object.conversation.Say;

public class PepperStory extends RobotActivity implements RobotLifecycleCallbacks {
    private int flagPage = 0;
    private int flagStart = 0;
    private int i;
    protected static String storyTitle;
    ProgressDialog loading;

    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.pepperstory);
        setSpeechBarDisplayStrategy(SpeechBarDisplayStrategy.IMMERSIVE);
        setSpeechBarDisplayPosition(SpeechBarDisplayPosition.TOP);
        QiSDK.register(this, this);
        //I SEGUENTI DUE COMANDI GLI HO TOLTI PERCHE' LA VISIBILITA' GONE E' MESSA DI DEFAULT PER IL TASTO PAGINA PRECEDENTE NELL'XML
        //findViewById(R.id.prev).setVisibility(View.GONE);
        //findViewById(R.id.previous).setVisibility(View.GONE);

        findViewById(R.id.button_atoz).setOnClickListener(v -> {
            flagPage = 0;
            findViewById(R.id.next_page).setVisibility(View.VISIBLE);
            findViewById(R.id.next).setVisibility(View.VISIBLE);
            findViewById(R.id.prev).setVisibility(View.GONE);
            findViewById(R.id.previous).setVisibility(View.GONE);
            getTitles(); });

        findViewById(R.id.button_ztoa).setOnClickListener(v -> {
            flagPage = 1;
            findViewById(R.id.next_page).setVisibility(View.VISIBLE);
            findViewById(R.id.next).setVisibility(View.VISIBLE);
            findViewById(R.id.prev).setVisibility(View.GONE);
            findViewById(R.id.previous).setVisibility(View.GONE);
            getTitles(); });

        findViewById(R.id.next_page).setOnClickListener(v -> {
            nextPage();
            findViewById(R.id.prev).setVisibility(View.VISIBLE);
            findViewById(R.id.previous).setVisibility(View.VISIBLE);});


        findViewById(R.id.previous).setOnClickListener(v -> {
            previousPage();
            findViewById(R.id.next_page).setVisibility(View.VISIBLE);
            findViewById(R.id.next).setVisibility(View.VISIBLE);});

        getTitles();
    }

    public void getTitles() {
        if(flagPage == 0) Collections.sort(GetTitles.titleList);
        if(flagPage == 1) Collections.sort(GetTitles.titleList, Collections.reverseOrder());
        i=0;

        if (GetTitles.titleList.size() <= 5) { //CAMBIATO DA == A <=
            findViewById(R.id.next_page).setVisibility(View.GONE);
            findViewById(R.id.next).setVisibility(View.GONE);
        } else if (GetTitles.titleList.size() > 5) {       //AGGIUNTO PER IL PRIMO AVVIO, NEL CASO LE STORIE SONO PIU' DI 5. VERIFICARE COSA SUCCEDE CON 3 PAGINE DI STORIE
            findViewById(R.id.next_page).setVisibility(View.VISIBLE);
            findViewById(R.id.next).setVisibility(View.VISIBLE);
        }

        try {
            TextView firstTitle = findViewById(R.id.titolo1);
            firstTitle.setText(GetTitles.titleList.get(i++));
            //AGGIUNTO PER AVVIARE STORIA
            findViewById(R.id.titolo1).setOnClickListener(v -> {
                storyTitle = String.valueOf(firstTitle.getText());
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            });

            TextView secondTitle = findViewById(R.id.titolo2);
            secondTitle.setText(GetTitles.titleList.get(i++));
            findViewById(R.id.titolo2).setOnClickListener(v -> {
                storyTitle = String.valueOf(secondTitle.getText());
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            });

            TextView thirdTitle = findViewById(R.id.titolo3);
            thirdTitle.setText(GetTitles.titleList.get(i++));
            findViewById(R.id.titolo3).setOnClickListener(v -> {
                storyTitle = String.valueOf(thirdTitle.getText());
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            });

            TextView fourthTitle = findViewById(R.id.titolo4);
            fourthTitle.setText(GetTitles.titleList.get(i++));
            findViewById(R.id.titolo4).setOnClickListener(v -> {
                storyTitle = String.valueOf(fourthTitle.getText());
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            });

            TextView fifthTitle = findViewById(R.id.titolo5);
            fifthTitle.setText(GetTitles.titleList.get(i++));
            findViewById(R.id.titolo5).setOnClickListener(v -> {
                storyTitle = String.valueOf(fifthTitle.getText());
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            });
        } catch (IndexOutOfBoundsException Exception) {}
    }

    public void nextPage() {
        QiSDK.register(this, this);
        try {
            if (i <= GetTitles.titleList.size()) {
                TextView firstTitle = findViewById(R.id.titolo1);
                Log.d("VALORE", "la nell'if vale " +i);
                firstTitle.setText(GetTitles.titleList.get(i++));
            }
        } catch (IndexOutOfBoundsException Exception) {}
        try {
            if (i <= GetTitles.titleList.size()) {
                TextView secondTitle = findViewById(R.id.titolo2);
                secondTitle.setText(GetTitles.titleList.get(i++));
            }
        } catch (IndexOutOfBoundsException Exception) {
            Log.d("VALORE", "la nel catch vale " +i);
            i+=3;
            TextView secondTitle = findViewById(R.id.titolo2);
            secondTitle.setText("");
            TextView thirdTitle = findViewById(R.id.titolo3);
            thirdTitle.setText("");
            TextView fourthTitle = findViewById(R.id.titolo4);
            fourthTitle.setText("");
            TextView fifthTitle = findViewById(R.id.titolo5);
            fifthTitle.setText("");
        }
        try {
            if (i <= GetTitles.titleList.size()) {
                TextView thirdTitle = findViewById(R.id.titolo3);
                thirdTitle.setText(GetTitles.titleList.get(i++));
            }
        } catch (IndexOutOfBoundsException Exception) {
            i+=2;
            TextView thirdTitle = findViewById(R.id.titolo3);
            thirdTitle.setText("");
            TextView fourthTitle = findViewById(R.id.titolo4);
            fourthTitle.setText("");
            TextView fifthTitle = findViewById(R.id.titolo5);
            fifthTitle.setText("");
        }
        try {
            if (i <= GetTitles.titleList.size()) {
                TextView fourthTitle = findViewById(R.id.titolo4);
                fourthTitle.setText(GetTitles.titleList.get(i++));
            }
        } catch (IndexOutOfBoundsException Exception) {
            i++;
            TextView fourthTitle = findViewById(R.id.titolo4);
            fourthTitle.setText("");
            TextView fifthTitle = findViewById(R.id.titolo5);
            fifthTitle.setText("");
        }
        try {
            if (i <= GetTitles.titleList.size()) {
                TextView fifthTitle = findViewById(R.id.titolo5);
                fifthTitle.setText(GetTitles.titleList.get(i++));
            }
        } catch (IndexOutOfBoundsException Exception) {
            TextView fifthTitle = findViewById(R.id.titolo5);
            fifthTitle.setText("");
        }

        if (i >= GetTitles.titleList.size()) {
            findViewById(R.id.next_page).setVisibility(View.GONE);
            findViewById(R.id.next).setVisibility(View.GONE);
        }
    }

    public void previousPage() {
        QiSDK.register(this, this);
        if(i <= 10) {
            findViewById(R.id.prev).setVisibility(View.GONE);
            findViewById(R.id.previous).setVisibility(View.GONE);
            getTitles();
        } else {
            TextView firstTitle = findViewById(R.id.titolo5);
            firstTitle.setText(GetTitles.titleList.get(i - 6));

            TextView secondTitle = findViewById(R.id.titolo4);
            secondTitle.setText(GetTitles.titleList.get(i - 7));

            TextView thirdTitle = findViewById(R.id.titolo3);
            thirdTitle.setText(GetTitles.titleList.get(i - 8));

            TextView fourthTitle = findViewById(R.id.titolo2);
            fourthTitle.setText(GetTitles.titleList.get(i - 9));

            TextView fifthTitle = findViewById(R.id.titolo1);
            fifthTitle.setText(GetTitles.titleList.get(i - 10));
            i-=5;
        }
    }

    @Override
    protected void onDestroy() {
        QiSDK.unregister(this, this);
        super.onDestroy();
    }

    @Override
    public void onRobotFocusGained(QiContext qiContext) {
        if(flagStart == 0) {
            Phrase initialPhrase = new Phrase("Scegli una storia presente nella lista per farmela raccontare. Per scorrere le pagine puoi dire avanti o indietro");
            Say say = SayBuilder.with(qiContext).withPhrase(initialPhrase).build();
            say.run();
            flagStart = 1;
        }

        PhraseSet vocalCmd = PhraseSetBuilder.with(qiContext).withTexts("avanti", "indietro").build();
        Log.d("TEMP", "vocalCMD: "+vocalCmd.getPhrases());
        //COME SI VEDE DAI LOG, vocalCMD CONTIENE DUE OGGETTI DISTINTI DI TIPO PHRASE (AVANTI E INDIETRO), INVECE lista CONTIENE UN SOLO OGGETTO PHRASE

        /*PhraseSet titoli = null;
        StringBuilder stringBuilder1 = new StringBuilder();
        String prova = null;
        for(int j=0; j<GetTitles.titleList.size(); j++) {
            if(j==GetTitles.titleList.size()-1) {
                prova = "\""+GetTitles.titleList.get(j)+"\"";
                stringBuilder1.append(prova);
                titoli = PhraseSetBuilder.with(qiContext).withTexts(stringBuilder1.toString()).build();
            }
            else {
                prova = "\""+GetTitles.titleList.get(j)+"\", ";
                stringBuilder1.append(prova);
            }
            Log.d("VALORE", "Prova: "+prova);
            Log.d("VALORE", "Prova stringbuilder: "+stringBuilder1);
        }*/

        //COSI' DEVE FUNZIONARE PER FORZA
        List<Phrase> phraseList = new ArrayList<>();
        for(String title: GetTitles.titleList) {
            Phrase phrase = new Phrase(title);
            phraseList.add(phrase);
        }
        PhraseSet titles = PhraseSetBuilder.with(qiContext).withPhrases(phraseList).build();
        Log.d("TEMP", "Titoli (phraselist): " +titles.getPhrases());

        Listen listen = ListenBuilder.with(qiContext).withPhraseSets(vocalCmd, titles).build();

        ListenResult listenResult = listen.run();
        Log.d("senti", "Heard phrase: " + listenResult.getHeardPhrase().getText()); // Prints "Heard phrase: forwards".

        if(listenResult.getHeardPhrase().getText().equals("Cappuccetto")) {
            Log.d("senti if", "Heard phrase: " + listenResult.getHeardPhrase().getText()); // Prints "Heard phrase: forwards".
            storyTitle = GetTitles.titleList.get(i);
            startActivity(new Intent(PepperStory.this, GetStory.class));
            finish();
        }

        if(listenResult.getHeardPhrase().getText().equals("biancaneve")) {
            Log.d("senti if", "Heard phrase: " + listenResult.getHeardPhrase().getText()); // Prints "Heard phrase: forwards".
            storyTitle = GetTitles.titleList.get(i);
            startActivity(new Intent(PepperStory.this, GetStory.class));
            finish();
        }

        if(listenResult.getHeardPhrase().getText().equals("avanti")) {
            runOnUiThread(() -> {
                nextPage();
                findViewById(R.id.prev).setVisibility(View.VISIBLE);
                findViewById(R.id.previous).setVisibility(View.VISIBLE);
            });
        }

        if(listenResult.getHeardPhrase().getText().equals("indietro")) {
            runOnUiThread(() -> {
                previousPage();
                findViewById(R.id.next_page).setVisibility(View.VISIBLE);
                findViewById(R.id.next).setVisibility(View.VISIBLE);
            });
        }

        //DA TESTARE COME AVVIO STORIA GENERICO VOCALE
        for(int i = 0; i < GetTitles.titleList.size(); i++) {
            Log.d("senti for", "Heard phrase: " + listenResult.getHeardPhrase().getText()); // Prints "Heard phrase: forwards".
            if(GetTitles.titleList.get(i).equalsIgnoreCase(listenResult.getHeardPhrase().getText())) {
                Log.d("senti if", "Heard phrase: " + listenResult.getHeardPhrase().getText()); // Prints "Heard phrase: forwards".
                storyTitle = GetTitles.titleList.get(i);
                Phrase selectedStory = new Phrase("Sto per raccontarvi la storia "+storyTitle);
                Say sayStory = SayBuilder.with(qiContext).withPhrase(selectedStory).build();
                sayStory.run();
                startActivity(new Intent(PepperStory.this, GetStory.class));
                finish();
            }
        }
    }

    @Override
    public void onRobotFocusLost() { }

    @Override
    public void onRobotFocusRefused(String reason) { }
    
    @Override
    public void onBackPressed() {
        startActivity(new Intent(PepperStory.this, MainActivity.class));
        GetTitles.titleList.clear();
        finish();
    }
}
