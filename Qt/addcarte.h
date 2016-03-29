#ifndef ADDCARTE_H
#define ADDCARTE_H

#include ".uic/ui_addcarte.h"
#include "coac.h"
#include "elevelist.h"

class COAC;
class EleveList;

class AddCarte : public QDialog, private Ui::AddCarte
{
    Q_OBJECT

private:
    COAC *fenetre;
    EleveList *elevelist;

public:
    explicit AddCarte(COAC* fen, QWidget *parent = 0);

public slots:
    void onPushActionAddClasse(bool i);
};

#endif // ADDCARTE_H
