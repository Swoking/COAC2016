#ifndef ADDCARTE_H
#define ADDCARTE_H

#include ".uic/ui_addcarte.h"
#include "coac.h"
#include "elevelist.h"
#include <QModelIndex>

class COAC;
class EleveList;

class AddCarte : public QDialog, private Ui::AddCarte
{
    Q_OBJECT

private:
    COAC *fenetre;
    EleveList *elevelist;
    int id;

public:
    explicit AddCarte(COAC* fen, QWidget *parent = 0);
    ~AddCarte();

public slots:
    void onPushActionAddClasse(bool i);
    void onDoubleClickListEleve(QModelIndex);
    void closeEvent(QCloseEvent *);
};

#endif // ADDCARTE_H
