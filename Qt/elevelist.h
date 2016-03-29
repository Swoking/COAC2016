#ifndef ELEVELIST_H
#define ELEVELIST_H

#include ".uic/ui_elevelist.h"
#include "coac.h"
#include "database.h"
#include "addcarte.h"

class COAC;
class Database;
class AddCarte;

class EleveList : public QDialog, private Ui::EleveList
{
    Q_OBJECT

private:
    COAC *fenetre;
    AddCarte *fenetreAddCarte;
    int idEleve;
    Database db;

    void showList();

public:
    explicit EleveList( COAC* fen, QWidget *parent = 0);
    EleveList( AddCarte *fen, QWidget *parent = 0);

};

#endif // ELEVELIST_H
